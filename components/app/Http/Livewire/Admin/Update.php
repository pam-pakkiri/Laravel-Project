<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Migration;
use Illuminate\Support\Facades\Artisan;
use Brotzka\DotenvEditor\DotenvEditor;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Admin\General;
use App\Models\Admin\Header;
use App\Models\Admin\ApiKeys as ApiKey;
use Illuminate\Support\Str;
use App\Models\Admin\Languages;
use App\Models\Admin\Translations;
use DateTime;
use File;
use App;
use Config;

class Update extends Component
{
    public function render()
    {

        //Meta
        $title = __('Update') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.update')->layout('layouts.update', [
            'siteTitle' => env('APP_NAME'),
            'general'   => General::first(),
            'header'    => Header::first()
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateDatabase
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateDatabase()
    {
        try {

            Artisan::call('migrate', ['--force' => true]);

            switch ( Config::get('app.version') ) {
                case '2.0.0':
                        $env = new DotenvEditor();

                        $env->addData([
                            "APP_SEPARATOR"               => "'-'",
                            "MAIL_TO_ADDRESS"             => null,
                            "GOOGLE_RECAPTCHA_SITE_KEY"   => null,
                            "GOOGLE_RECAPTCHA_SECRET_KEY" => null,
                            "GOOGLE_CLIENT_ID"            => null,
                            "GOOGLE_CLIENT_SECRET"        => null,
                            "GOOGLE_REDIRECT_URL"         => "/auth/google/callback",
                            "FACEBOOK_CLIENT_ID"          => null,
                            "FACEBOOK_CLIENT_SECRET"      => null,
                            "FACEBOOK_REDIRECT_URL"       => "/auth/facebook/callback",
                            "USE_REMOTE_LIBREOFFICE"      => false
                        ]);

                        $indexnow_api_key          = (string) Str::uuid();
                        $indexnow_api_key          = preg_replace('[-]', '', $indexnow_api_key);
                        $api_key                   = ApiKey::findOrFail(1);
                        $api_key->indexnow_api_key = $indexnow_api_key;
                        $api_key->updated_at       = new DateTime();
                        $api_key->save();

                    break;
                
                default:
                    // code...
                    break;
            }

            $this->onImportTranslations();            

            Artisan::call('config:clear');

            Artisan::call('cache:clear');

            Artisan::call('view:clear');

            File::delete('update.php');

            session()->flash('status', 'success');
            session()->flash('message', __( 'Data updated successfully!' ));

        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  arrayKeySearch
     * -------------------------------------------------------------------------------
    **/
    private function arrayKeySearch($array, $key) {

        $result = (array_search($key, array_column($array, 'key')));

        return ($result === 0) ? true : $result;
    }
    
    /**
     * -------------------------------------------------------------------------------
     *  onImportTranslations
     * -------------------------------------------------------------------------------
    **/
    private function onImportTranslations()
    {
        try {

                $transFilePath = dirname(base_path()) . '/translations.json';

                $fileContents = File::get($transFilePath);
                
                $deJson    = json_decode($fileContents);

                $langID = Languages::where('default', true)->first()->id;

                $transArray = Translations::where('lang_id', $langID)->get(['key', 'value'])->toArray();

                foreach ($deJson as $key => $value) {

                    $check = $this->arrayKeySearch($transArray, $key);

                    if ( !$check ){
                        $trans             = new Translations;
                        $trans->key        = $key;
                        $trans->value      = $value;
                        $trans->lang_id    = $langID;
                        $trans->created_at = new DateTime();
                        $trans->save();
                    }
                }

                //Export translation to JSON file
                
                $transData = Translations::where('lang_id', $langID)->get(['key', 'value']);

                $defaultLocate = Languages::where('default', true)->first()->code;

                $arrayData = array();

                foreach ($transData as $value) {
                    $arrayData += array( strip_tags($value['key']) => strip_tags($value['value']) );
                }

                $jsonData = json_encode($arrayData, true);

                File::put( App::langPath() . ('/' . $defaultLocate . '.json'), $jsonData );

                File::delete($transFilePath);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()) );
            
        }
    }

}

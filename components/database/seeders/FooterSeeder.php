<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Footer;
use App\Models\Admin\FooterTranslation;
use File, DateTime;
class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          $footers = File::get('components/database/contents/footers.json');

          $footers = json_decode($footers);

          foreach ($footers as $footer) {

              Footer::create(array(
                "id"          => $footer->id,
                "created_at"  => new DateTime()
              ));

              foreach ($footer->translations as $footerTran) {

                   FooterTranslation::create([
                      "id"          => $footerTran->id,
                      "locale"      => $footerTran->locale,
                      "layout"      => 5,
                      "widget1"     => '<h3 class="text-primary font-weight-bolder">About Us</h3> <p>Vestibulum quis risus sed nisl pellentesque aliquet et et lorem.</p> <p>Fusce nibh nisl, gravida nec ipsum eu, feugiat condimentum velit.</p>',
                      "widget2"     => '<h3 class="text-primary font-weight-bolder">Features</h3> <ul class="flex-column ms-n3 nav"> <li class="nav-item"><a class="nav-link ps-0" title="Help Center" href="#">Help Center</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Paid with Mobile" href="#">Paid with Mobile</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Status" href="#">Status</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Changelog" href="#">Changelog</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Contact Support" href="#">Contact Support</a></li> </ul>',
                      "widget3"     => '<h3 class="text-primary font-weight-bolder">Support</h3> <ul class="flex-column ms-n3 nav"> <li class="nav-item"><a class="nav-link ps-0" title="Home" href="#">Home</a></li> <li class="nav-item"><a class="nav-link ps-0" title="About" href="#">About</a></li> <li class="nav-item"><a class="nav-link ps-0" title="FAQs" href="#">FAQs</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Support" href="#">Support</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Contact" href="#">Contact</a></li> </ul>',
                      "widget4"     => '<h3 class="text-primary font-weight-bolder">Trending</h3> <ul class="flex-column ms-n3 nav"> <li class="nav-item"><a class="nav-link ps-0" title="Shop" href="#">Shop</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Portfolio" href="#">Portfolio</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Blog" href="#">Blog</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Events" href="#">Events</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Forums" href="#">Forums</a></li> </ul>',
                      "widget5"     => '<h3 class="text-primary font-weight-bolder">Legal</h3> <ul class="flex-column ms-n3 nav"> <li class="nav-item"><a class="nav-link ps-0" title="Knowledge Center" href="#">Knowledge Center</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Custom Development" href="#">Custom Development</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Sponsorships" href="#">Sponsorships</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Terms &amp; Conditions" href="#">Terms &amp; Conditions</a></li> <li class="nav-item"><a class="nav-link ps-0" title="Privacy Policy" href="#">Privacy Policy</a></li> </ul>',
                      "bottom_text" => '<p>Copyrights © %year%. All Rights Reserved by <a title="ThemeLuxury" href="https://themeluxury.com/" target="_blank" rel="noopener">ThemeLuxury</a>.</p>',
                      "footer_id"   => $footer->id
                  ]);

              }

          }

    }
}

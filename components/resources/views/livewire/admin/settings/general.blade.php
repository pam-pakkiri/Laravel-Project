<div>

	@php

		$google_fonts = json_decode($google_fonts, true);

		$timezones = json_decode($timezones, true);

	@endphp

	<form wire:submit.prevent="onUpdateGeneral">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<div class="row">
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title">{{ __('Site Settings') }}</h3>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover settings">
							<tr>
								<td class="align-middle"><label class="form-label mb-0">{{ __('Site Name') }}</label></td>
								<td class="w-75">
									<input type="text" class="form-control" wire:model="appname">
								</td>
							</tr>

							<tr>
								<td class="align-middle"><label class="form-label mb-0">{{ __('Separator Character') }}</label></td>
								<td class="w-75">
									<div class="form-selectgroup">
										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="-">
											<span class="form-selectgroup-label">-</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="–">
											<span class="form-selectgroup-label">–</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="—">
											<span class="form-selectgroup-label">—</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value=":">
											<span class="form-selectgroup-label">:</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="»">
											<span class="form-selectgroup-label">»</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="•">
											<span class="form-selectgroup-label">•</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value="|">
											<span class="form-selectgroup-label">|</span>
										</label>

										<label class="form-selectgroup-item">
											<input type="radio" name="separator" class="form-selectgroup-input" wire:model="separator" value=">">
											<span class="form-selectgroup-label">></span>
										</label>
									</div>

								</td>
							</tr>

							<tr>
								<td class="align-middle"><label class="form-label mb-0">{{ __('Preview') }}</label></td>
								<td class="w-75">
									<div class="form-switch ps-0">
										<h5 class="text-primary h3 mb-0">{{ __('Post Title') . ' ' . $this->separator . ' ' . $this->appname}}</h5>
										<span class="text-green">{{ env('APP_URL') }}/post-title</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title">{{ __('Parallax Settings') }}</h3>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover settings">

							<tr>
								<td class="align-middle"><label for="parallax-status" class="form-label mb-0">{{ __('Enable Parallax') }}</label></td>
								<td class="w-75">
									<div class="form-switch ps-0">
										<input id="parallax-status" class="form-check-input ms-auto" type="checkbox" wire:model="parallax_status">
									</div>
								</td>
							</tr>
							@if ( $parallax_status )
								<tr>
									<td class="align-middle"><label for="parallax-image" class="form-label mb-0">{{ __('Parallax Image') }}</label></td>
									<td class="align-middle">
										<div class="input-group">
											<span class="input-group-btn">
												<a id="parallax-image" data-input="parallax-thumbnail" data-preview="parallax-preview" class="btn btn-primary">
													<i class="fa fa-picture-o"></i> {{ __('Choose') }}
												</a>
											</span>
											<input id="parallax-thumbnail" class="form-control ps-2" type="text" wire:model="parallax_image">
										</div>

										<div class="screenshot my-2 w-25">
											<div class="img-fluid shadow border-radius-xl overlay-preview rounded" style="
												@if ( $overlay_type == 'solid' )

												background: {{ $solid_color }};opacity: {{ $opacity }};

												@elseif( $overlay_type == 'gradient' )

												background: {{ $gradient_first_color }};
												background: -moz-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }}  );
												background: -webkit-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
												background: linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
												opacity: {{ $opacity }};

												@endif

											"></div>
											<img class="img-fluid shadow border-radius-xl parallax-preview" src="{{ $parallax_image }}" style="filter: blur({{ $blur }}px);">
										</div>

									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="social" class="form-label mb-0">{{ __('Overlay Type') }}</label></td>
									<td class="align-middle">
										<select class="form-control" wire:model="overlay_type">
											<option value="solid">{{ __('Solid') }}</option>
											<option value="gradient">{{ __('Gradient') }}</option>
										</select>
									</td>
								</tr>

								@if ( $overlay_type == 'solid' )

									<tr>
										<td class="align-middle"><label for="color_picker" class="form-label mb-0">{{ __('Choose Solid Color') }}</label></td>
										<td class="align-middle ps-0"><input class="form-control form-control-color" id="color_picker" wire:model="solid_color" type="color"></td>
									</tr>

								@elseif( $overlay_type == 'gradient' )

									<tr>
										<td class="align-middle"><label for="ads-area-1" class="form-label mb-0">{{ __('Choose Gradient Color') }}</label></td>
										<td class="align-middle">
											<table class="table table table-vcenter card-table">
												<tr>
													<td class="align-middle ps-0"><input class="form-control form-control-color" id="gradient_first_color" wire:model="gradient_first_color" type="color"></td>
													<td class="align-middle"><input class="form-control form-control-color" id="gradient_second_color" wire:model="gradient_second_color" type="color"></td>
													<td class="align-middle">
														<select class="form-control" wire:model="gradient_position">
															<option value="to top" selected="selected">{{ __('To Top') }}</option>
															<option value="to right">{{ __('To Right') }}</option>
															<option value="to bottom">{{ __('To Bottom') }}</option>
															<option value="to left">{{ __('To Left') }}</option>
														</select>
													</td>
												</tr>
											</table>
										</td>
									</tr>

								@endif

								<tr>
									<td class="align-middle"><label for="opacity" class="form-label mb-0">{{ __('Opacity') }}</label></td>
									<td class="align-middle">
										<div class="w-100">
											<input id="opacity" class="form-range overlay-opacity" wire:model="opacity" type="range" min="0" max="1" step="0.1" value="0.2">
											<span class="text-muted">{{ __('Opacity') }}: <span>{{ $opacity }}</span>{{ __('px') }}</span>
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="blur" class="form-label mb-0">{{ __('Blur') }}</label></td>
									<td class="align-middle">
										<div class="w-100">
											<input id="blur" class="form-range background-blur" type="range" wire:model="blur" min="0.0" max="10" step="0.5" value="1.5">
											<span class="text-muted">{{ __('Blur') }}: <span>{{ $blur }}</span>{{ __('px') }}</span>
										</div>
									</td>
								</tr>
							@endif
						</table>

					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title">{{ __('Other Settings') }}</h3>
					</div>
					<div class="card-body">
							<table class="table table-bordered table-hover settings">
								<tr>
									<td class="align-middle"><label for="maintenance_mode" class="form-label mb-0">{{ __('Enable Maintenance Mode') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="maintenance_mode" class="form-check-input ms-auto" type="checkbox" wire:model.defer="maintenance_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="theme_mode" class="form-label mb-0">{{ __('Enable Theme Mode (Light / Dark)') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="theme_mode" class="form-check-input ms-auto" type="checkbox" wire:model.defer="theme_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="default_theme_mode" class="form-label mb-0">{{ __('Default Theme Mode') }}</label></td>
									<td class="align-middle">
										<div class="input-group">
				                            <select name="align" id="default_theme_mode" class="form-control" wire:model.defer="default_theme_mode">
			                                    <option value="theme-light">{{ __('Light') }}</option>
			                                    <option value="theme-dark">{{ __('Dark') }}</option>
				                            </select>
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="dir_mode" class="form-label mb-0">{{ __('Enable Dir Mode (LTR / RTL)') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="dir_mode" class="form-check-input ms-auto" type="checkbox" wire:model.defer="dir_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="adblock_detection" class="form-label mb-0">{{ __('Enable Adblock Detection') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="adblock_detection" class="form-check-input ms-auto" type="checkbox" wire:model.defer="adblock_detection">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="automatic_language_detection" class="form-label mb-0">{{ __('Enable Automatic Language Detection') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="automatic_language_detection" class="form-check-input ms-auto" type="checkbox" wire:model.defer="automatic_language_detection">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="language_switcher" class="form-label mb-0">{{ __('Enable Language Switcher') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="language_switcher" class="form-check-input ms-auto" type="checkbox" wire:model.defer="language_switcher">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="page-load" class="form-label mb-0">{{ __('Enable Page Load') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="page-load" class="form-check-input ms-auto" type="checkbox" wire:model.defer="page_load">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="lazy-loading" class="form-label mb-0">{{ __('Enable Lazy Loading') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="lazy-loading" class="form-check-input ms-auto" type="checkbox" wire:model.defer="lazy_loading">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="back_to_top" class="form-label mb-0">{{ __('Enable Back to Top') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch">
											<input id="back_to_top" class="form-check-input" type="checkbox" wire:model.defer="back_to_top">
										</div>
									</td>
								</tr>
								
								<tr>
									<td class="align-middle"><label for="share-icons-status" class="form-label mb-0">{{ __('Enable Share Icons') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="share-icons-status" class="form-check-input ms-auto" type="checkbox" wire:model.defer="share_icons_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="author-box-status" class="form-label mb-0">{{ __('Enable Author Box') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="author-box-status" class="form-check-input ms-auto" type="checkbox" wire:model.defer="author_box_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="author-box-status" class="form-label mb-0">{{ __('Enable Search Box') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="author-box-status" class="form-check-input ms-auto" type="checkbox" wire:model.defer="search_box_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="blog-page-status" class="form-label mb-0">{{ __('Enable Blog Page') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="author-box-status" class="form-check-input ms-auto" type="checkbox" wire:model="blog_page_status">
										</div>
									</td>
								</tr>

								@if ( $blog_page_status )
									<tr>
										<td class="align-middle"><label for="blog_page_count" class="form-label mb-0">{{ __('Number of posts to show') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
												<input id="blog_page_count" type="text" class="form-control" wire:model.defer="blog_page_count">
											</div>
										</td>
									</tr>
								@endif

								<tr>
									<td class="align-middle"><label for="related-tools-status" class="form-label mb-0">{{ __('Enable Related Tools') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch mb-0 ps-0">
											<input id="author-box-status" class="form-check-input ms-auto" type="checkbox" wire:model.defer="related_tools">
										</div>
									</td>
								</tr>

								@if ( $related_tools )
									<tr>
										<td class="align-middle"><label for="related_tools_count" class="form-label mb-0">{{ __('Number of Related Tools to show') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
												<input id="related_tools_count" type="text" class="form-control" wire:model.defer="related_tools_count">
											</div>
										</td>
									</tr>

									<tr>
										<td class="align-middle"><label for="related_tools_background" class="form-label mb-0">{{ __('Background for Related Tools') }}</label></td>
										<td class="align-middle">
											<div class="input-group">
					                            <select name="align" id="related_tools_background" class="form-control" wire:model.defer="related_tools_background">
					                                <optgroup label="{{ __('Base colors') }}">
					                                    <option value="bg-white">{{ __('White') }}</option>
					                                    <option value="bg-blue">{{ __('Blue') }}</option>
					                                    <option value="bg-azure">{{ __('Azure') }}</option>
					                                    <option value="bg-indigo">{{ __('Indigo') }}</option>
					                                    <option value="bg-purple">{{ __('Purple') }}</option>
					                                    <option value="bg-pink">{{ __('Pink') }}</option>
					                                    <option value="bg-red">{{ __('Red') }}</option>
					                                    <option value="bg-orange">{{ __('Orange') }}</option>
					                                    <option value="bg-yellow">{{ __('Yellow') }}</option>
					                                    <option value="bg-lime">{{ __('Lime') }}</option>
					                                    <option value="bg-green">{{ __('Green') }}</option>
					                                    <option value="bg-teal">{{ __('Teal') }}</option>
					                                    <option value="bg-cyan">{{ __('Cyan') }}</option>
					                                </optgroup>
					                                <optgroup label="{{ __('Light colors') }}">
					                                    <option value="bg-blue-lt">{{ __('Blue') }}</option>
					                                    <option value="bg-azure-lt">{{ __('Azure') }}</option>
					                                    <option value="bg-indigo-lt">{{ __('Indigo') }}</option>
					                                    <option value="bg-purple-lt">{{ __('Purple') }}</option>
					                                    <option value="bg-pink-lt">{{ __('Pink') }}</option>
					                                    <option value="bg-red-lt">{{ __('Red') }}</option>
					                                    <option value="bg-orange-lt">{{ __('Orange') }}</option>
					                                    <option value="bg-yellow-lt">{{ __('Yellow') }}</option>
					                                    <option value="bg-lime-lt">{{ __('Lime') }}</option>
					                                    <option value="bg-green-lt">{{ __('Green') }}</option>
					                                    <option value="bg-teal-lt">{{ __('Teal') }}</option>
					                                    <option value="bg-cyan-lt">{{ __('Cyan') }}</option>
					                                </optgroup>
					                            </select>
											</div>
										</td>
									</tr>
								@endif

						        <tr>
						            <td class="align-middle">
						            	<label class="form-label mb-0">{{ __('Enable the icon before the tool name') }}</label>
						            </td>
						            <td class="w-75">
						                <div class="form-switch ps-0">
						                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="icon_before_tool_name_status">
						                </div>
						            </td>
						        </tr>

						        <tr>
						            <td class="align-middle">
						            	<label class="form-label mb-0">{{ __('Enable featured images of posts in the sidebar') }}</label>
						            </td>
						            <td class="w-75">
						                <div class="form-switch ps-0">
						                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="featured_images_in_sidebar_status">
						                </div>
						            </td>
						        </tr>
				        
								<tr>
									<td class="align-middle"><label for="file_size" class="form-label mb-0">{{ __('Maximum Upload File Size') }}</label></td>
									<td class="align-middle">
										<div class="input-group">
											<input id="file_size" type="text" class="form-control" wire:model.defer="file_size">
											<span class="input-group-text">{{ __('MB') }}</span>
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="prefix" class="form-label mb-0">{{ __('Prefix for Download Files') }}</label></td>
									<td class="align-middle"><input id="prefix" type="text" class="form-control" wire:model.defer="prefix"></td>
								</tr>

								<tr>
									<td class="align-middle"><label for="timezone" class="form-label mb-0">{{ __('Timezone') }}</label></td>
									<td wire:ignore>
										<select class="form-control" wire:model.defer="timezone">
											@foreach ($timezones as $key => $value)
												<optgroup label="{{ $value['group'] }}">

													@foreach ($value['zones'] as $key2 => $value2)
														<option value="{{ $value2['value'] }}">{{ $value2['value'] }}</option>
													@endforeach

												</optgroup>
											@endforeach
										</select>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="font_family" class="form-label mb-0">{{ __('Font Family') }}</label></td>
									<td wire:ignore>
										<select class="form-control" wire:model.defer="font_family">
											<optgroup label="{{ __('Google Fonts') }}">
												@foreach ($google_fonts as $key => $value)

													<option value="{{ $key }}">{{ $key }}</option>

												@endforeach

											</optgroup>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2">

										<div class="d-flex">
											<label for="social" class="form-label mb-0">{{ __('Social Media') }}</label>

											<div class="form-check form-switch mb-0">
												<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="social_status">
											</div>
										</div>
										<div class="d-flex mb-3 mt-2">
											<small class="form-hint">{{ __('These social media buttons are at the Footer.') }}</small>
										</div>
										@foreach ($socials as $index => $social)
										
											<div class="row">
												<div class="col-md-5">
													<div class="form-group mb-3">
														<select class="form-control" wire:model.defer="socials.{{ $index }}.name">
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'socials.' . $index . '.name' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group mb-3">
														<input type="text" class="form-control" placeholder="URL" wire:model.defer="socials.{{ $index }}.url">
														@error( 'socials.' . $index . '.url' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>

												@if ( $index == 0 )

													<div class="col-md-2">
														<button class="btn text-white btn-info w-100" wire:click.prevent="addSocial( {{ $i }} )">{{ __('Add new') }}</button>
													</div>

												@else
													<div class="col-md-2">
														<button class="btn btn-danger w-100" wire:click.prevent="onDeleteSocial({{ $social['id'] }})">{{ __('Remove') }}</button>
													</div>
												@endif

											</div>
										@endforeach

										@foreach($inputs as $key => $value)
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<select wire:model.defer="name.{{ $value }}" class="form-control">
															<option value selected style="display:none;">{{ __('Choose a social...') }}</option>
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'name.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="URL" wire:model.defer="url.{{ $value }}">
														@error( 'url.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-2">
													<button class="btn btn-danger w-100" wire:click.prevent="removeSocial({{ $key }})">{{ __('Remove') }}</button>
												</div>
											</div>
										@endforeach
									</td>
								</tr>
							</table>
					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<button class="btn btn-primary float-end" wire:loading.attr="disabled">
					<span>
						<div wire:loading.inline wire:target="onUpdateGeneral">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>
		</div>
	</form>

<div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

		jQuery('#parallax-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#parallax-thumbnail').change(function() { 
			window.livewire.emit('onSetParallaxImage', this.value)
		});

		jQuery('input#parallax-thumbnail').change(function() { 
			window.livewire.emit('onSetParallaxImage', this.value)
		});

    });

})( jQuery );
</script>
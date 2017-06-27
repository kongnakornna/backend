<?php
			if (!$this->session->userdata('user_name')) {

			} else {
				$userinput = $this->session->userdata('user_name');
			}
		//Debug($this->session->userdata);
		//Debug($configweb);
$language = $this->lang->language; 

?>
<style type="text/css">
div span.input-icon input {border-radius: 5px !important; width:100%}
div.form-group div input {border-radius: 5px !important;width:100%}
div.form-group div textarea {border-radius: 5px !important;width:100%}
.input-icon > .ace-icon {left: 15px;}
#admin_email, #address{width:300px;}
</style>
						<div class="page-header">
							<h1>
								<?php echo $language['settings']; ?> <?php echo $language['website']; ?>
								<small>
									<!-- <i class="ace-icon fa fa-angle-double-right"></i> -->
									<?php //echo $userinput; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">
									<div class="pull-right"></div>
								</div>

								<div>
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">
											<!-- <div class="well well-sm">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												&nbsp;
												<div class="inline middle blue bigger-110"> Your profile is 70% complete </div>

												&nbsp; &nbsp; &nbsp;
												<div style="width:200px;" data-percent="70%" class="inline middle no-margin progress progress-striped active">
													<div class="progress-bar progress-bar-success" style="width:70%"></div>
												</div>
											</div> -->
											<!-- /.well -->

<!-- message -->		
<?php
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $error?>.
									<br>
							</div>
				</div>
<?php
			}
?>
<?php
			if(isset($success)){
?>
				<div class="col-xs-12">
							<div class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $success?>.
									<br>
							</div>
				</div>
<?php
			}
?>
<!-- Form -->		
			<div class="space"></div>
<?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open_multipart('setting/save', $attributes);
?>
<ul>
	<?php if(@$upload_data) foreach ($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?></li>
	<?php endforeach; ?>
</ul>

					<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																<?php echo $language['basic_info'] ?>
															</a>
														</li>

														<!-- <li>
															<a data-toggle="tab" href="#edit-settings">
																<?php //echo $language['settings'] ?>
																<i class="purple ace-icon fa fa-signal bigger-125"></i>
																<?php echo $language['activity'] ?>
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																<?php echo $language['password'] ?>
															</a>
														</li> -->
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<!-- edit-basic -->
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller"><?php echo $language['general'] ?></h4>

															<div class="row">
																<!-- <div class="col-xs-12 col-sm-4">
																	<div id="upload_avatar"><input type="file" name="admin_avatar" /></div>
																</div> -->

																<div class="vspace-12-sm"></div>

																<div class="col-xs-12 col-sm-9">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">ชื่อเว็ปไซด์</label>
																		<div class="col-sm-8">

																					<input class="col-xs-12 col-sm-12" name="webname" type="text" id="webname" placeholder="ชื่อเว็ปไซด์" value="<?php if($configweb['webname']) echo $configweb['webname'] ?>" />

																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Description</label>

																		<div class="col-sm-8">
																					<textarea class="col-xs-12 col-sm-12" name="description"id="description" placeholder="Description" rows="" cols=""><?php if($configweb['description']) echo $configweb['description'] ?></textarea>
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Keyword</label>

																		<div class="col-sm-8">
																					<input class="col-xs-12 col-sm-12" name="keyword" type="text" id="keyword" placeholder="Keyword" value="<?php if($configweb['keyword']) echo $configweb['keyword'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Author</label>

																		<div class="col-sm-8">
																					<input class="col-xs-12 col-sm-12" name="author" type="text" id="author" placeholder="author" value="<?php if(isset($configweb['author'])) echo $configweb['author'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Copyright</label>

																		<div class="col-sm-8">
																					<input class="col-xs-12 col-sm-12" name="copyright" type="text" id="copyright" placeholder="copyright" value="<?php if(isset($configweb['copyright'])) echo $configweb['copyright'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																</div>

															</div>


															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['contact'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="admin_email"><?php echo $language['email'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input name="admin_email" type="email" id="admin_email" value="<?php if($configweb['admin_email']) echo $configweb['admin_email'] ?>"  class="col-xs-12 col-sm-12" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
																</div>
																<div class="help-block inline"></div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="address"><?php echo $language['address'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<textarea class="col-xs-12 col-sm-12" name="address" id="address" placeholder="<?php echo $language['address'] ?>" rows="" cols=""><?php if(isset($configweb['address'])) echo $configweb['address'] ?></textarea>

																	</span>
																</div>
																<div class="help-block inline"></div>
															</div>

															<div class="space-4"></div>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['phone'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input name="phone" class="input-medium input-mask-phone" type="text" id="form-field-phone" value="<?php if($configweb['phone']) echo $configweb['phone'] ?>"  class="col-xs-12 col-sm-12" />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>


													<div>
															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['social'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="facebook" id="form-field-facebook" class="col-xs-12 col-sm-12" value="<?php if($configweb['facebook']) echo $configweb['facebook'] ?>" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="twitter" id="form-field-twitter" class="col-xs-12 col-sm-12" value="<?php if($configweb['twitter']) echo $configweb['twitter'] ?>" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-youtube">Youtube</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="youtube" id="form-field-youtube" class="col-xs-12 col-sm-12" value="<?php if(isset($configweb['youtube'])) echo $configweb['youtube'] ?>" />
																		<i class="ace-icon fa fa-youtube red"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-instagram">Instagram</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="instagram" id="form-field-instagram" class="col-xs-12 col-sm-12" value="<?php if(isset($configweb['instagram'])) echo $configweb['instagram'] ?>" />
																		<i class="ace-icon fa fa-instagram brow"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="google" id="form-field-gplus" class="col-xs-12 col-sm-12" value="<?php if($configweb['google']) echo $configweb['google'] ?>" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>

													</div>
<!--  -->


													<!-- <div>
															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['social'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="facebook" id="form-field-facebook" class="col-xs-12 col-sm-12" value="<?php if($configweb['facebook']) echo $configweb['facebook'] ?>" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="twitter" id="form-field-twitter" class="col-xs-12 col-sm-12" value="<?php if($configweb['twitter']) echo $configweb['twitter'] ?>" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="google" id="form-field-gplus" class="col-xs-12 col-sm-12" value="<?php if($configweb['google']) echo $configweb['google'] ?>" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>
													</div> -->

											</div>
											
											<div class="space-4"></div>

														<!-- Settings -->
														<!-- 
														<div id="edit-settings" class="tab-pane">
															<div class="space-10"></div>

															<div class="row">
						
																<div class="col-sm-12"> -->


															<!-- <div class="row">
																<div class="col-sm-6">
																	
																	<span class="bigger-110"><?php echo $language['activity'] ?></span>
																</div>
															</div>

															<div class="space"></div>
															<select data-placeholder="Choose a menu..." id="select-menu" class="chosen-select" multiple="" style="display: none;">
<?php
				/*if($admin_menu){
						$allmenu = count($admin_menu);
						for($m=0;$m<$allmenu;$m++){
								$row = $admin_menu[$m];
								echo '<option value="'.$row->_admin_menu_id.'">'.$row->_title.'</option>';
								
								$submenu = $this->menufactory->getMenu($row->_admin_menu_id, $admin_id);
								if($submenu){
										$allsubmenu = count($submenu);
										for($n=0;$n<$allsubmenu;$n++){
												$subrow = $submenu[$n];
												echo '<option value="'.$subrow->_admin_menu_id.'"> - '.$subrow->_title.'</option>';
										}
								}

						}
				}*/
?>
															</select>							

																</div>
															</div>
										
														</div> -->

														<!-- edit-password -->
														<!-- <div id="edit-password" class="tab-pane">
															<div class="space-10"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1"><?php echo $language['new_password'] ?></label>

																<div class="col-sm-9">
																	<input type="password" name="password1" id="form-field-pass1" value='' disabled/>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2"><?php echo $language['confirm_password'] ?></label>

																<div class="col-sm-9">
																	<input type="password" name="password2" id="form-field-pass2" value='' disabled/>
																</div>
															</div>
														</div>
													</div> -->

												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" id="send">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Save
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
												</div>
											<?php echo form_close();?>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php 

?>
		/*$('#bootbox-confirm').click(function( ) {
				var v = $(this).attr('data-value');
				var img = $(this).attr('data-img');
				$.ajax({
						type: 'POST',
						url: "<?php echo base_url() ?>admin/remove_img/" + v,
						data : { img : img},
						cache: false,
						success: function(data){
								if(data = 'Yes'){
										//alert(data);
										$('#admin_avatar').attr('style', 'display:none');
										$('#upload_avatar').attr('style', 'display:block');
								}
						}
				});
		});*/
});

</script>
<?php //echo js_asset('checkall.js'); ?>


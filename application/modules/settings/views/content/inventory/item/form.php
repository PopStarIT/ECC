<div class="row">
	<div class="col-xl-12 mb-30">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>">New Item</h5>
				<form class="ui grid form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
					<?php 
						$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
						$this->ecc_library->form('hidden','',"form_".$methodid,'item_base_id','');
					?>	
					
					<div class="row">		
						<div class="col-xl-6">
							<div class="row">		
								<div class="col-xl-12">
									<?php 
										$this->ecc_library->form('text','Item Code',"form_".$methodid,'item_base_code','','','');
										$this->ecc_library->form('text','Item Name',"form_".$methodid,'item_base_name','','','');
										$this->ecc_library->form('select','Item Category',"form_".$methodid,'item_category_id','','','item_category');
										$this->ecc_library->form('select','Units of Measure',"form_".$methodid,'uom_id','','','uom');
										$this->ecc_library->form('select','KITE Item Type',"form_".$methodid,'custom_item_kite_type_id','','','custom_item_kite_type');
										$this->ecc_library->form('select','HS Code',"form_".$methodid,'hs_id','','','hs_code');
									?>
								</div>
							</div>
							
							<div class="row">		
								<div class="col-xl-4">
									<?php 
										$this->ecc_library->form('text','Brand',"form_".$methodid,'merk','','','');
									?>
								</div>
								
								<div class="col-xl-4">
									<?php 
										$this->ecc_library->form('text','Type',"form_".$methodid,'tipe','','','');
									?>
								</div>
								
								<div class="col-xl-4">
									<?php 
										$this->ecc_library->form('text','Other Spesification',"form_".$methodid,'spesifikasi_lain','','','');
									?>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6">
							<?php 
								$this->ecc_library->form('select','Item Type',"form_".$methodid,'mb_flag_id','','','mb_flag');
								$this->ecc_library->form('select','Tax Group',"form_".$methodid,'tax_group_id','','','tax_group');
								$this->ecc_library->form('select','Sales Account',"form_".$methodid,'sales_gl_account_id','','','gl_account');
								$this->ecc_library->form('select','Inventory Account',"form_".$methodid,'inventory_gl_account_id','','','gl_account');
								$this->ecc_library->form('select','C.O.G.S Account',"form_".$methodid,'cogs_gl_account_id','','','gl_account');
								$this->ecc_library->form('select','Inventory Adjustment Account',"form_".$methodid,'adjustment_gl_account_id','','','gl_account');
								$this->ecc_library->form('select','WIP Account',"form_".$methodid,'wip_gl_account_id','','','gl_account');
							?>
						</div>
					</div>
				</form>
				<br>	
				<div class="ui grid form">
					<div class="row field">
						<div class="twelve wide column">
							<button type="button" class="btn btn-success" onclick="save_<?php echo $methodid ?>()">
								<i class="fa fa-save"></i> Save
							</button>
							
							<button type="button" class="btn btn-info" onclick="cancel_<?php echo $methodid ?>()">
								<i class="fa fa-arrow-left"></i> Back
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>   
	</div>
</div>
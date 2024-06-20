<div class="row">
	<div class="col-xl-12 mb-30">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>">New <?php echo $page_title ?></h5>
				<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
					<?php 
						$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
						$this->ecc_library->form('hidden','',"form_".$methodid,'warehouse_id','');
						$this->ecc_library->form('text','Warehouse Code',"form_".$methodid,'warehouse_code','','','');
						$this->ecc_library->form('text','Warehouse Name',"form_".$methodid,'warehouse_name','','','');
						
					?>	
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
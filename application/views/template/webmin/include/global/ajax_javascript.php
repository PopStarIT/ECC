<!-- START PLUGINS -->
<script type="text/javascript">
	var baseurl = "<?php echo base_url() ?>";
	var full_path_template = "<?php echo BASEDIR . "assets/" . $path_template ."/" ?>";
	var plugin_path = "<?php echo BASEDIR . "assets/" . $path_template ."/js/" ?>";
</script>
<?php 
	if(isset($load_js)){
		if(is_array($load_js)){
			foreach($load_js as $dt_js){
				if(substr($dt_js,0,8) == 'https://'){
					echo "<script src='". $dt_js ."'></script>";
				} elseif(substr($dt_js,0,7) == 'http://'){
					echo "<script src='". $dt_js ."'></script>";
				} else {
					$this->load->view('javascript/'.$dt_js);
				}
			}
		} else {
			if(substr($load_js,0,8) == 'https://'){
				echo "<script src='". $load_js ."'></script>";
			} elseif(substr($load_js,0,7) == 'http://'){
				echo "<script src='". $load_js ."'></script>";
			} else {
				$this->load->view('javascript/'.$load_js);
			}
		}
	} 
?>
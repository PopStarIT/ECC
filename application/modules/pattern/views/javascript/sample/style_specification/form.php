<script type="text/javascript">
//alert("coba view");
   var new_style_spec=1;
   var style_spec_header_id =0;
   var style_speckaryawan_lock_data=0;
   var style_spec_open_form =0;
   
	var new_purchase_order = 1;
	var purchase_order_id = 0;
	var purchase_type_id = 1;
	var purchase_order_this_memo = 0;
	var purchase_order_lock_data = 0;
	var purchase_order_open_form = 0;
    
   
	//	var edit_detail_id = 0;

    var idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [],
	updateIdsOfSelectedRows_<?php echo $methodid ?>_detail_spec = function (id, isSelected) {
		//alert(id);
		var index = $.inArray(id, idsOfSelectedRows_<?php echo $methodid ?>_detail_spec);
		if (!isSelected && index >= 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_detail_spec.splice(index, 1); // remove id from the list
			//alert(id);
		//alert("No");
		} else if (index < 0) {
			idsOfSelectedRows_<?php echo $methodid ?>_detail_spec.push(id);
			//var id = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getGridParam','selrow');
			//if (id) {
			//  var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData',id);
            // // alert(row['r4']);
			//}
		//alert("Ok");
		}
	};


	$(".form_tab_<?php echo $methodid ?>").on("click", "a", function (e) {
	   //alert("coba view");
	    e.preventDefault();
		idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [];
			  
		setTimeout(function(){ 
				   		
			//$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
			//$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
			
				   		
			$("#table_<?php echo $methodid ?>_detail_spec").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');

		
	     	$("#table_<?php echo $methodid ?>_detail_spec_temp").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_detail_spec_temp").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec_temp').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_detail_history").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_detail_history").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_history').width() - 20,true).trigger('resize');

						
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 1000);
    });
	
	var grid = $("#table_<?php echo $methodid ?>_detail_spec");
    var getColumnIndexByName = function(gr,columnName) {
       var cm = gr.jqGrid('getGridParam','colModel');
       for (var i=0,l=cm.length; i<l; i++) {
		 //  alert(cm[7].name);
         if (cm[i].name===columnName) {
            return i; // return the index
         }
       }
    return -1;
   };
	
	var changeEditableByContain = function(gr,colName,text,doNonEditable) {
         var pos=getColumnIndexByName(gr,colName);
		// alert (pos);
       // nth-child need 1-based index so we use (i+1) below
        var cells = $("tbody > tr.jqgrow > td:nth-child("+(pos+1)+")",gr[0]);
        for (var i=0; i<cells.length; i++) {
              var cell = $(cells[i]);
			//alert(cell);
			console.log(cell[i]);
            //var cellText = cell.text();
         //  var unformatedText = $.unformat(cell,{rowId:cell[0].id,
         //                               colModel:gr[0].p.colModel[pos]},pos);
		   // console.log(unformatedText);
       //    if (text === unformatedText) { // one can use cell.text() instead of
                                       // unformatedText if needed
                if (doNonEditable) {
                    // cell.addClass('not-editable-cell');
			  	    cell.addClass('ui-state-highlight edit-cell');
					cell.append('<input type="text" id="'+i+'_r6" role="textbox" style="width:100%; box_sizing:border-box;">')
                } else {
                   // cell.removeClass('not-editable-cell');
				    cell.removeClass('edit-cell');
                }
         //  }
		}
     };
	
	$(function () {
        "use strict";
	  $("#table_<?php echo $methodid ?>_detail_spec").jqGrid({
		    url: baseurl+'<?php echo $class_uri ?>/loaddata_detail',
			datatype: "json",
			mtype : "post",
			postData:{'q':'1'
			           ,'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
			           , style_spec_header_id : function (){
						         //  $('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val(data[0].style_spec_header_id);
							return $('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val();	
						}
			           ,'date':'<?php echo date("Y-m-d") ?>'
					   , style_spec_header_id2 :$('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val()
					  },
			colNames:['#','DETAIL_ID','ID','SIZE','POINT OF MEASURE','BASIC','SIZE XS', 'SIZE S', 'SIZE M', 'SIZE L', 'SIZE XL', 'SIZE XXL','#'],
			colModel:[
			   {name:'r13',index:'r13',align:'center',width:30,"searchoptions":{"clearSearch":false}},
			   {name:'r1',index:'r1', width:50,hidden: true,"searchoptions":{"clearSearch":false}},
			   {name:'r2',index:'r2', width:50,hidden: true,"searchoptions":{"clearSearch":false} },
			   {name:'r3',index:'r3', width:50,hidden: true,"searchoptions":{"clearSearch":false}},
			  // {name:'r3',index:'r3', width:100,align:'center'},
			//   {name:'r4',index:'r4', width:200,editable: true, resizable: true, edittype: "select", formatter: "select" ,
			//   editoptions: { 
			//   value: "1:BODY LENGTH FRONT;2:BODY LENGTH BACK;3:SHOULDER WIDTH;4:CHEST (1"+ '"' +" FROM A/PIT)"} ,"searchoptions":{"clearSearch":false}
			//   },
			   {name:'r4',index:'r4', width:200,editable: true},
			   {name:'r5',index:'r5', width:60,editable: true,"searchoptions":{"clearSearch":false}},
			   {name:'r6',index:'r6', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			      formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                         var spec_id = row[rowId-1]['r1'];
						 var uraian = row[rowId-1]['r4'];
						 var nilai_info=row[rowId-1]['r6'];
						 //alert(formula_s);
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_xs');
						 $('#form_<?php echo $methodid ?>_formula_size').val('xs');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						
						  
                         edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_xs');
						 $('#view_modal').modal('show');
					//	 let keterangan='0';
					//	 var Nama = row[rowId-1]['r3'];
					//	 const date_start = $('#form_<?php echo $methodid ?>_date_start').val(),
					//	     date_end = $('#form_<?php echo $methodid ?>_date_end').val();
					//	  $('#view_modal_s').modal('show');  //---popupshow
					//	  send_keterangan(badgenumber,Nama,keterangan,date_start,date_end);
					//	  $('#form_<?php echo $methodid ?>_badgenumber3').val(rowData.r2);
					  }
                  }
			   },
			   {name:'r7',index:'r7', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			   	formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                       	 var spec_id = row[rowId-1]['r1'];
						 var uraian = row[rowId-1]['r4'];
						 var nilai_info=row[rowId-1]['r7'];
						 
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('');
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val('');
						 //alert(formula_s);
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_s');
						 $('#form_<?php echo $methodid ?>_formula_size').val('s');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						 
						 
                          edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_s');
						  $('#view_modal').modal('show');
				
					  }
                  }		  
			   },
			   {name:'r8',index:'r8', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			   formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                       	 var spec_id = row[rowId-1]['r1'];
						 var uraian = row[rowId-1]['r4'];
						 var nilai_info=row[rowId-1]['r8'];
						 
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('');
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val('');
						 
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_m');
						 $('#form_<?php echo $methodid ?>_formula_size').val('m');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						 
                          edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_m');
						  $('#view_modal').modal('show');
					//	 let keterangan='0';
					//	 var Nama = row[rowId-1]['r3'];
					//	 const date_start = $('#form_<?php echo $methodid ?>_date_start').val(),
					//	     date_end = $('#form_<?php echo $methodid ?>_date_end').val();
					//	  $('#view_modal_s').modal('show');  //---popupshow
					//	  send_keterangan(badgenumber,Nama,keterangan,date_start,date_end);
					//	  $('#form_<?php echo $methodid ?>_badgenumber3').val(rowData.r2);
					  }
                  }	
			   },
			   
			   {name:'r9',index:'r9', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			     formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                       	 var spec_id = row[rowId-1]['r1'];
						 var uraian = row[rowId-1]['r4'];
						 var nilai_info=row[rowId-1]['r9'];
						 
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('');
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val('');
						 
						 
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_l');
						 $('#form_<?php echo $methodid ?>_formula_size').val('l');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						 
                          edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_l');
						  $('#view_modal').modal('show');
					//	 let keterangan='0';
					//	 var Nama = row[rowId-1]['r3'];
					//	 const date_start = $('#form_<?php echo $methodid ?>_date_start').val(),
					//	     date_end = $('#form_<?php echo $methodid ?>_date_end').val();
					//	  $('#view_modal_s').modal('show');  //---popupshow
					//	  send_keterangan(badgenumber,Nama,keterangan,date_start,date_end);
					//	  $('#form_<?php echo $methodid ?>_badgenumber3').val(rowData.r2);
					  }
                  }	
			   },
			   {name:'r10',index:'r10', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			     formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                         var spec_id = row[rowId-1]['r1'];
						 var uraian = row[rowId-1]['r4'];
						 var nilai_info=row[rowId-1]['r10'];
						 //alert(formula_s);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('');
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val('');
						 
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_xl');
						 $('#form_<?php echo $methodid ?>_formula_size').val('xl');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						 
                          edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_xl');
						  $('#view_modal').modal('show');
					//	 let keterangan='0';
					//	 var Nama = row[rowId-1]['r3'];
					//	 const date_start = $('#form_<?php echo $methodid ?>_date_start').val(),
					//	     date_end = $('#form_<?php echo $methodid ?>_date_end').val();
					//	  $('#view_modal_s').modal('show');  //---popupshow
					//	  send_keterangan(badgenumber,Nama,keterangan,date_start,date_end);
					//	  $('#form_<?php echo $methodid ?>_badgenumber3').val(rowData.r2);
					  }
                  }	
			   },
			   {name:'r11',index:'r11', width:60,"searchoptions":{"clearSearch":false},formatter:'dynamicLink',
			     formatoptions: {
					  onClick: function (cellValue, rowId, rowData,e){
						 var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');
                         var spec_id = row[rowId-1]['r1'];
						  var uraian = row[rowId-1]['r4'];
						  var nilai_info=row[rowId-1]['r11'];
						 //alert(formula_s);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('');
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val('');
						 
						 $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val(spec_id);
						 $('#form_<?php echo $methodid ?>_formula_nama_formula').val('formula_spec_xxl');
						 $('#form_<?php echo $methodid ?>_formula_size').val('xxl');
						 $('#form_<?php echo $methodid ?>_formula_uraian').val(uraian);
						 $('#form_<?php echo $methodid ?>_formula_nilai_info').val(nilai_info);
						 
                          edit_detail_formula_<?php echo $methodid ?>(spec_id,'formula_spec_xxl');
						  $('#view_modal').modal('show');
					
					  }
                  }	
			   },
			    {name:'kode',index:'kode', width:170, editable:false,
			   formatter:function (cellvalue, options, rowObject) { 
			    // cellvalue = typeof cellvalue !== 'undefined' ? cellvalue : '0.00';
                //  var rows= jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData');				 
                   //  var rowNum2=$("#table_<?php echo $methodid ?>_detail_spec").getGridParam("selrow");	
                   //  var rowNum=$("#table_<?php echo $methodid ?>_detail_spec").getRowData(rowNum2);					 
                   //  var optionsRowId = options.rowId;
					// return  rowObject.methodid;
					return '<button class="btn btn-xs btn-success" onclick="javascript:simpan_spec_<?php echo $methodid ?>'+'(' + rowObject.r1 +')"><i class="fa fa-save"></i> Save</button> <button class="btn btn-xs btn-danger" onclick="javascript:delete_spec_<?php echo $methodid ?>' +'(' + rowObject.r1 +')"><i class="fa fa-trash-o"></i> Delete</button>';
			//delete_spec_
			//		 return "<input type='button' style=\"background-color:#29b2e1;color:white:padding:0px\" value='Save' onclick=\"javascript:testRow('" + rowObject.r1 + "')\">         <input type='button' style=\"background-color:red;color:white\" value='Deleted' onclick=\"javascript:testRow2('" + rowObject.r1 + "')\" \>";
					 }
			     // return rowObject.r4  ;}
              // return "<input type='button' style=\"background-color:lightgreen;color:black\" value='SAVE' onclick=\"javascript:testRow('" + rowObject.ship_via + "')\" \>";}
			  
			   }
			 ],
			 
		//	rowNum:-1,
		//	multiselect: true,
		//	sortname: 'r1',
		//	viewrecords: true,
		//	sortorder: "asc",
		//	height: 250,	
		//	shrinkToFit:false,
		//	jsonReader: { repeatitems : false },
		//	forceFit:true,
		//	cellEdit:true,
		//	loadonce : true,
		//	cellsubmit: 'clientArray',
		//	rownumbers: true,
		//	pager: '#ptable_<?php echo $methodid ?>_detail_spec',
			 
			iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			multiselect: true,
			rowNum:30,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>_detail_spec',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:false,
			cellEdit:true,
			autowidth: true,
			height: 250,
           	jsonReader: {repeatitems : false},
			viewrecords : true,
			gridview:true,
			onSelectRow: updateIdsOfSelectedRows_<?php echo $methodid ?>_detail_spec,
			onSelectAll: function (aRowids, isSelected) {
				var i, count, id;
				for (i = 0, count = aRowids.length; i < count; i++) {
					id = aRowids[i];
					//alert (id);
				//	console.log(id);
					updateIdsOfSelectedRows_<?php echo $methodid ?>_detail_spec(id, isSelected);
				}
			},
			loadComplete: function () {
				var rowData = $("#table_<?php echo $methodid ?>_detail_spec").getRowData();
				//var grid=$("#table_<?php echo $methodid ?>_detail_spec");
				//$("#grid_id").setCell(rowId, 'price', '', {'background-color':'#' + data.colorHEX});
				// $("#table_<?php echo $methodid ?>_detail_spec").setCell(rowId, 'SIZE S', '', {'background-color':'#FFFFFF'});
			 
			   // alert(rowData[4]);
				//console.log(rowData[4-1]);
				for (var i = 0; i < rowData.length; i++) {
				//	alert(set_decimalPlaces(rowData[i].r5,12));
				  //alert(rowData[i].r3);
				 if (rowData[i].r3 === 'S'){
					 $("#table_<?php echo $methodid ?>_detail_spec").jqGrid("setLabel","r5","BASIC S");
					// changeEditableByContain(grid,'r5','test',true);
					//  $('#table_<?php echo $methodid ?>_detail_spec').setColProp(rowData[i].r5,{editable:true})
					  //  alert("EDIT");
					 //  jQuery('#gridid').editRow(id, true)
					    // $('#table_<?php echo $methodid ?>_detail_spec').setColProp(rowData[i].r5,{editable:true})
				//		 $("#table_<?php echo $methodid ?>_detail_spec").jqGrid("setColProp", rowData[i].r5, {editable:true});
						 // $('#table_<?php echo $methodid ?>_detail_spec').editRow(rowData[i].r5, true);
					     //jQuery('#table_<?php echo $methodid ?>_detail_spec').editRow(rowData[i].r5, true);
					  // $(this).editRow(rowData[i].r5, true);
				  }else{
					   $("#table_<?php echo $methodid ?>_detail_spec").jqGrid("setLabel","r5","BASIC M");
					  //alert("EDIT");
				  }
				// $this.jqGrid('setSelection', idsOfSelectedRows_<?php echo $methodid ?>_detail_spec[i], false);
					//rowData[i].r5=set_decimalPlaces(rowData[i].r5,12)
				  //	if(rowData[i].r12 == 0 ){
						$(this).jqGrid('setSelection', rowData[i].r1, true);
						
				//	} else {
				//		$this.jqGrid('setSelection', idsOfSelectedRows_<?php echo $methodid ?>_detail_spec[i], false);
					//}
				}
			}
			
			}); 
		$("#table_<?php echo $methodid ?>_detail_spec").jqGrid("setColProp", "rn", {hidedlg: false});
				 	
		$("#table_<?php echo $methodid ?>_detail_spec").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_detail_spec',{edit:false,add:false,del:false,view:false,search: false});
      			
		$("#table_<?php echo $methodid ?>_detail_spec").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});
		
	});
	
		
	var check_copy_model = 0;
	$('#form_<?php echo $methodid ?>_detail_style_spec_detail_model_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		//	var data = $("#form_<?php echo $methodid ?>_detail_model").serialize();
		//var check_copy_model = 1;
	   if(check_copy_model == 0) {
		 //  check_copy_model=1;
		 //  alert(model_id);
		 //check_submit = 1;
			// $("#table_<?php echo $methodid ?>_detail_spec").jqGrid('setGridParam',{
		    //         	postData: {
		    //         		      '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
		    //         		      ,'q':'4'
		    //         		      ,model_id : $('#form_<?php echo $methodid ?>_detail_style_spec_detail_model_id').val()
		    //         			  ,basic_id : $('#form_<?php echo $methodid ?>_detail_basic_id').val()
		    //         		  } 
		    //         	
		    //           });
		             
		         $("#table_<?php echo $methodid ?>_detail_spec").trigger("reloadGrid", { fromServer: true, page: 1 });
		         $("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');	
				 
				 $("#table_<?php echo $methodid ?>_detail_spec_temp").trigger("reloadGrid", { fromServer: true, page: 1 });
		         $("#table_<?php echo $methodid ?>_detail_spec_temp").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec_temp').width() - 20,true).trigger('resize');
		
	   }
		//change_form_<?php echo $methodid ?>_detail_item_id(data[0].item_id);
		//purchase_order_get_purchase_data();
	});
		
     function fontColorFormat_basic(cellvalue, options, rowObject) {
         var color = "Red";
		 var cellHtml = "<span style='color:" + color + "' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }
	 
	function cancel_<?php echo $methodid ?>(){
		//alert('cancel');
		$('#panel_content_<?php echo $methodid ?>').show();
		$('#panel_content_form_<?php echo $methodid ?>').hide();
	//	$('#panel_uploadexcel_form_ echo $methodid ?>').hide();
	//	$('#panel_content_form_upload_ echo $methodid ?>').hide();
		$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
	}

	function upload_excel_<?php echo $methodid ?>(){	
		//page_loading("show",'echo $page_title ?>','Please Wait...');
		const datafrm= new FormData();
		//var datax = $("#form_excel_ echo $methodid ?>").serialize();
		var datax =  $("#form_excel_<?php echo $methodid ?>").serialize();
	  
	    var data2 =  $("#form_excel_<?php echo $methodid ?>").serializeArray();
		var file_data = $('#form_excel_<?php echo $methodid ?>_excel_karyawan').prop('files')[0];

	    $.each(data2, function (key,input) {
	      datafrm.append(input.name,input.value);
	    });

    	if(file_data){
			datafrm.append('file',file_data);
			datafrm.append('info','Yes_excel');
		}else{
            datafrm.append('info','No_excel');
		} 
		//console.log(file_data);
		//alert(<?php echo $methodid ?>);
		
		$.ajax({
			url: baseurl +'<?php echo $class_uri ?>/upload_excel_karyawan',
			type: 'POST',
			processData:false,
			contentType:false,
			data: datafrm, 
			dataType: 'json',
			success: function(data){
				page_loading("hide");
				show_success("show",'<?php echo $page_title ?>',data.isi_file);	
				//alert('upload');
			   
				setTimeout(function(){ 
					$('.tab_scrollbar').getNiceScroll().resize(); 
				}, 90);
			}
		});
		
	}

	function submit_excel_<?php echo $methodid ?>(){
		$('#form_excel_<?php echo $methodid ?>').submit();
		//$('#form_excel_ echo $methodid ?>').submit(function(e) {
		//	alert('data');
        //    e.preventDefault();    
        //  
        // });
	}
	function save_<?php echo $methodid ?>(){
	   $('#form_<?php echo $methodid ?>').submit();
	}
	
	function save_<?php echo $methodid ?>_biodata(){
		//alert('form_<?php echo $methodid ?>_biodata');
		$('#form_<?php echo $methodid ?>_biodata').submit();
	}
	
	var jvalidate = $("#form_<?php echo $methodid ?>").validate({
		ignore: [],
		rules: {                                            
			gl_account_group: {
				required: true
			}
		} 
	});
	
	function edit_<?php echo $methodid?>(id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert(id +'loader');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_style_specification_edit'
				,param_pop: 'db_pop'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//$('.button_<?php echo $methodid ?>_keluarga_edit').hide();
				//$('.button_<?php echo $methodid ?>_keluarga_new').show();	

                //$('.button_<?php echo $methodid ?>_dokumen_edit').hide();
				//$('.button_<?php echo $methodid ?>_dokumen_new').show();				
				//alert(data[0].style_spec_header_id);			
				//var pic = document.getElementById("picture");
				//const elementBaru = document.createElement('p');
				$('#form_<?php echo $methodid ?>_style_spec_header_id').val(data[0].style_spec_header_id);
				$('#form_<?php echo $methodid ?>_style_spec_nomor').val(data[0].nomor);
				$('#form_<?php echo $methodid ?>_style_spec_pattern').val(data[0].pattern_code);
				$('#form_<?php echo $methodid ?>_style_spec_date').val(data[0].date);
				$('#form_<?php echo $methodid ?>_date_in').val(data[0].date_in);
				$('#form_<?php echo $methodid ?>_style_spec_pabric').val(data[0].fabric);
				$('#form_<?php echo $methodid ?>_susut').val(data[0].susut);
				$('#form_<?php echo $methodid ?>_buyer').val(data[0].buyer);
				$('#form_<?php echo $methodid ?>_po').val(data[0].po);
				$('#form_<?php echo $methodid ?>_note').val(data[0].note);
				//detail_style_spec_header_id 
				//'form_'. $methodid .'_detail_style_spec_header_id
				$('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val(data[0].style_spec_header_id);
				$('#form_<?php echo $methodid ?>_detail_info_spec').val('edit');
				//$('#form_<?php echo $methodid ?>_detail_keterangan_spec').val('EDIT');
				
				$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
				$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
				
				$('.panel_<?php echo $methodid ?>_panel_detail').show();
				
				$("#table_<?php echo $methodid ?>_detail_spec").trigger('reloadGrid');
				$("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');
				$('.tab_scrollbar').getNiceScroll().resize(); 
				
				setTimeout(function(){ 
				  $("#table_<?php echo $methodid ?>_detail_spec").trigger('reloadGrid');
				  $("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');
				  $('.tab_scrollbar').getNiceScroll().resize(); 
				}, 500);
			
				setTimeout(function(){ 
					$('.tab_scrollbar').getNiceScroll().resize(); 
				}, 90);
			}
		});
	}
	
	var check_submit = 0;
	function post_<?php echo $methodid ?>(){
		if(check_submit == 0) {
		//	alert("fgggggggg");
			idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [];
			check_submit = 1;
			page_loading("show",'Save <?php echo $page_title ?>','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>").serialize();
		//	console.log(data);
			$.ajax({
			    url: baseurl+'<?php echo $class_uri ?>/post_add_edit',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [];
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?>',data.message);	
						
						if(new_style_spec == 1){
							new_style_spec = 0;
							$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_detail").click();
							style_spec_header_id = data.style_spec_header_id;
							$('#form_<?php echo $methodid ?>_style_spec_header_id').val(style_spec_header_id);
							$('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val(style_spec_header_id);
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
							
							//if(style_spec_header_id == 1){
								$('.panel_<?php echo $methodid ?>_panel_detail').show();
							//	$('.panel_<?php echo $methodid ?>_panel_purchase_request').hide();
							//} else {
							//	$('.panel_<?php echo $methodid ?>_panel_detail').hide();
							//	$('.panel_<?php echo $methodid ?>_panel_purchase_request').show();
								
							//}
							
						} else {
							new_style_spec = 1;
							$('#panel_content_<?php echo $methodid ?>').show();
							$('#panel_content_form_<?php echo $methodid ?>').hide();
							$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
						}
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again process');
					check_submit = 0;
				}
			});
	
		}
	}
	
	/* Detail Function */
	
	var beforeclick_<?php echo $methodid ?>_purchase_request = function (rowid, e) {
		$("#table_<?php echo $methodid ?>_purchase_request").jqGrid('resetSelection');
		return(true);
	}
	
	var jvalidate2 = $("#form_<?php echo $methodid ?>_detail").validate({
		ignore: [],
		rules: {                                            
			item_id: {
				required: true
			},
			'quantity_ordered': {
				min: 0
			}
		} 
	});
	
	
		// $("#table_<?php echo $methodid ?>_detail_spec").jqGrid('setGridParam',{
		    //         	postData: {
		    //         		      '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
		    //         		      ,'q':'4'
		    //         		      ,model_id : $('#form_<?php echo $methodid ?>_detail_style_spec_detail_model_id').val()
		    //         			  ,basic_id : $('#form_<?php echo $methodid ?>_detail_basic_id').val()
		    //         		  } 
		    //         	
		    //           });
			
	function copy_<?php echo $methodid ?>_spec_detail(){
	    $("#table_<?php echo $methodid ?>_detail_spec").jqGrid('setGridParam',{
	         postData: {
	            '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	            ,'q':'4'
	            ,model_id : $('#form_<?php echo $methodid ?>_detail_style_spec_detail_model_id').val()
	            ,basic_id : $('#form_<?php echo $methodid ?>_detail_basic_id').val()
			    ,header_id : $('#form_<?php echo $methodid ?>_detail_style_spec_header_id').val()
	         } 
	            	
	   });
	   
	    $("#table_<?php echo $methodid ?>_detail_spec").trigger("reloadGrid", { fromServer: true, page: 1 });
		$("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');
		
	}
	
	function edit_detail_formula_<?php echo $methodid ?>(spec_id,formula){
		//page_loading("show",'<?php echo $page_title ?>','Please Wait
        var info=$('#form_<?php echo $methodid ?>_detail_info_spec').val();
		$('#form_<?php echo $methodid ?>_formula_info').val(info);
       // alert(info);
			$.ajax({
			    url: baseurl+'<?php echo $class_uri ?>/find_formula',
			    data: {
				   '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				   ,spec_id: spec_id
				   ,formula: formula
				   ,info:info
			    },
			    dataType: 'json',
			    method: 'post',
			     success: function(data){
					// page_loading("hide");
					 $('#form_<?php echo $methodid ?>_formula').val(data['formula_spec']);
					  $('#form_<?php echo $methodid ?>_formula_nilai_awal').val(data['formula_spec']);
				
			     }
			});
			
	}
	
	function save_<?php echo $methodid ?>_spec_formula(){
		//page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		
		var spec_id = $('#form_<?php echo $methodid ?>_formula_detail_Spec_id').val();
		var nama_formula = $('#form_<?php echo $methodid ?>_formula_nama_formula').val();
		var nilai_formula = $('#form_<?php echo $methodid ?>_formula').val();
		var uraian = $("#form_<?php echo $methodid ?>_formula_uraian").val();
		var info = $("#form_<?php echo $methodid ?>_formula_info").val();
		var nilai_db = $("#form_<?php echo $methodid ?>_formula_nilai_awal").val();
		var nilai_tabel = $("#form_<?php echo $methodid ?>_formula_nilai_info").val();
		var header_id = $("#form_<?php echo $methodid ?>_detail_style_spec_header_id").val();
		//alert(header_id);
		$.ajax({
			    url: baseurl+'<?php echo $class_uri ?>/save_formula',
			    data: {
				   '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				   ,header_id: header_id
				   ,spec_id: spec_id
				   ,nama_formula : nama_formula
				   ,uraian : uraian
				   ,nilai_formula : nilai_formula
				   ,info: info
				   ,nilai_db: nilai_db
				   ,nilai_tabel: nilai_tabel
				  },
			    dataType: 'json',
			    method: 'post',
			     success: function(data){
					// page_loading("hide");
					// alert(data['message']);
					 
			       $("#table_<?php echo $methodid ?>_detail_spec").trigger("reloadGrid", { fromServer: true, page: 1 });
                   $("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');
				   
				   $("#table_<?php echo $methodid ?>_detail_history").trigger('reloadGrid');
				   
			     }
			});
		
	}
	var check_copy_submit = 0;
	function copy_<?php echo $methodid ?>_spec(){
		if(check_copy_submit == 0) {
			check_copy_submit =1;
			page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>_detail").serialize();
			// alert(data);
		   // alert(baseurl+'<?php echo $class_uri ?>/copy_template');
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/copy_template',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						 setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
					}else{
						show_error("show",'Error',data.message);
					}
					
				},error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again copy');
					check_submit = 0;
				}
			});
		}
	 }
	 
	 function copy_<?php echo $methodid ?>_spec_awal(){
		if(check_copy_submit == 0) {
			check_copy_submit =1;
			page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>_detail").serialize();
		  //  alert(data);
		  //--nama url di ajax dirubah sebelumnya copy_template lalu ditambahkan (_awal)utk hasil tidak tau berhasil atau tidak namun sebelumnya OK
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/copy_template_awal',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						 setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
					}else{
						show_error("show",'Error',data.message);
					}
					
				},error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	 }
	
	var check_submit = 0;
	function add_<?php echo $methodid ?>_biodata(){
		new_karyawan = 0;
		//alert('data');
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'<?php echo $page_title ?> Biodata','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>_biodata").serialize();
			//alert(data);
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_biodata',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?> Biodata',data.message);	
						
						    $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
						
					   	    $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_keluarga").click();
							
							karyawan_id = data.karyawan_id;
							biodata_id = data.biodata_id;
							$('#form_<?php echo $methodid ?>_keluarga_karyawan_id').val(karyawan_id);
							$('#form_<?php echo $methodid ?>_biodata_id').val(biodata_id);
							
							//$('#form_<?php echo $methodid ?>_keluarga_id').val(karyawan_id);
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_keluarga").setGridWidth($('.grid_container_<?php echo $methodid; ?>_keluarga').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
						
						//$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
						//cancel_detail_<?php echo $methodid ?>();
						//$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
									
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
   var check_submit_keluarga = 0;
   function add_<?php echo $methodid ?>_keluarga(){
	  new_karyawan_keluarga = 0;
	  
	   if(check_submit_keluarga == 0) {
		  page_loading("show",'<?php echo $page_title ?> Keluarga','Please Wait...');
		   var data = $("#form_<?php echo $methodid ?>_keluarga").serialize();
		    // alert(data);
			 $.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_keluarga',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
				  page_loading("hide");
				  check_submit_keluarga = 0;
                  $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
						
			      $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
				
                  $("#tab_<?php echo $methodid; ?>_dokumen").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_dokumen").removeClass( "tab_disabled");
				  
				  $("#tab_<?php echo $methodid; ?>_keluarga").click();					  
				
				  karyawan_id = data.karyawan_id;
				  //biodata_id = data.biodata_id;
							$('#form_<?php echo $methodid ?>_keluarga_karyawan_id').val(karyawan_id);
							$('#form_<?php echo $methodid ?>_dokumen_karyawan_id').val(karyawan_id);
							
							$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_pendidikan').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val('');
			   	            $('#form_<?php echo $methodid ?>_keluarga_id').val('');
			   
			              //  change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id(data[0].kode_status);
				          //change_form_<?php echo $methodid ?>_keluarga_gender_keluarga(data[0].kode_gender);
				
				
			               $('.button_<?php echo $methodid ?>_keluarga_edit').hide();
			               $('.button_<?php echo $methodid ?>_keluarga_new').show();	
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_keluarga").setGridWidth($('.grid_container_<?php echo $methodid; ?>_keluarga').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500); 
				   
				  show_success("show",'Information',data.message);
                }					
			 });
	     }
	}
	
	var check_submit_dokumen = 0;
	function add_<?php echo $methodid ?>_dokumen(){
	  new_dokumen_keluarga = 0;
	   if(check_submit_dokumen == 0) {
		  // page_loading("show",'<?php echo $page_title ?> Dokumen','Please Wait...');
		   var data = $("#form_<?php echo $methodid ?>_dokumen").serialize();
			
			let frmdok= new FormData();
			
			var data2 =  $("#form_<?php echo $methodid ?>_dokumen").serializeArray();
			$.each(data2, function (key,input) {
				frmdok.append(input.name,input.value);
			});
			
			const file_data = $('#form_<?php echo $methodid ?>_lokasi_dokumen').prop('files')[0];
			//console.log(file_data);
			if(file_data){
				frmdok.append('file',file_data);
				frmdok.append('info',"Yes");
			}else{
				frmdok.append('info',"No");
			}
			
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_dokumen',
				type:'post',
				data: frmdok,
				processData:false,
				contentType:false,
				dataType:'json',
				success: function(data){
					page_loading("hide");
					check_submit_dokumen = 0;
					if(data.valid){
						 $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
				  	      
			             $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
				         
                         $("#tab_<?php echo $methodid; ?>_dokumen").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_dokumen").removeClass( "tab_disabled");
				         $("#tab_<?php echo $methodid; ?>_dokumen").click();	

                           karyawan_id = data.karyawan_id;
                      	 $('#form_<?php echo $methodid ?>_dokumen_karyawan_id').val(karyawan_id);	
						 $('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
                           setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_dokumen").setGridWidth($('.grid_container_<?php echo $methodid; ?>_dokumen').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500); 
				   
				       show_success("show",'Information',data.message);						 
					}
				}
			});
	    // alert('dokumen');
	   }
	}
	
	function edit_detail_<?php echo $methodid ?>(style_spec_header_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
			//alert(style_spec_header_id);
			$.ajax({
			    url: baseurl+'loader',
			    data: {
				   '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				   ,param: 'data_style_specification_detail'
				   ,param_pop: 'db_pop'
				   ,id : style_spec_header_id
			    },
			    dataType: 'json',
			    method: 'post',
			     success: function(data){
					 page_loading("hide");
			       //	console.log(data[0]);
					$('#form_<?php echo $methodid ?>_detail_point_of_measure').val(data[0].point_of_measure); 
			     }
			});
			
	}
	
	function edit_detailx_<?php echo $methodid ?>(purchase_order_detail_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert(baseurl+'loader');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_purchase_order_detail'
				,id : purchase_order_detail_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//console.log(data[0]);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_id').val(data[0].purchase_order_detail_id);
				$('#form_<?php echo $methodid ?>_detail_quantity_ordered').val(data[0].quantity_ordered);
				$('#form_<?php echo $methodid ?>_detail_order_delivery_date').val(data[0].order_delivery_date);
				$('#form_<?php echo $methodid ?>_detail_conversion').val(data[0].conversion);
				$('#form_<?php echo $methodid ?>_detail_unit_price').val(data[0].unit_price);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_memo').val(data[0].purchase_order_detail_memo);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_Style').val(data[0].po_style);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_composition').val(data[0].po_composition);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_intruction').val(data[0].po_intruction);
				
				if(purchase_type_id == 1){
					$('.button_<?php echo $methodid ?>_detail_edit').show();
					$('.button_<?php echo $methodid ?>_detail_new').hide();	
					
					change_form_<?php echo $methodid ?>_detail_item_id(data[0].item_id);
					change_form_<?php echo $methodid ?>_detail_uom_id(data[0].uom_id);
				} else {
					$("#table_<?php echo $methodid ?>_purchase_request").trigger('reloadGrid');
				}		
			}
		});
	}
	
	function edit_keluarga_<?php echo $methodid ?>(keluarga_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_keluarga_detail'
				,param_pop:'db_pop'
				,id : keluarga_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//console.log(data[0]);
				//alert(data[0].kode_status);
				$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val(data[0].nama_keluarga);
				$('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val(data[0].pekerjaan);
				$('#form_<?php echo $methodid ?>_keluarga_pendidikan').val(data[0].pendidikan);
				$('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val(data[0].tempat_lahir);
				$('#form_<?php echo $methodid ?>_keluarga_id').val(data[0].keluarga_id);
			   
			    change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id(data[0].kode_status);
				change_form_<?php echo $methodid ?>_keluarga_gender_keluarga(data[0].kode_gender);
				
				
			   $('.button_<?php echo $methodid ?>_keluarga_edit').show();
			   $('.button_<?php echo $methodid ?>_keluarga_new').hide();	
			}
		});
	}
	
	function delete_keluarga_<?php echo $methodid ?>(keluarga_id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Keluarga ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
			  if (result.value) {
			    page_loading("show",'Delete <?php echo $page_title ?> Keluarga','Please Wait...');
				 $.ajax({
					 url: baseurl+'<?php echo $class_uri ?>/delete_keluarga',								
					 data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',keluarga_id:keluarga_id},
					 dataType: 'json',
					 method: 'post',
					success: function(data){
						page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> keluarga',data.message);			
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								cancel_keluarga_<?php echo $methodid ?>();
								
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
					},
					 error: function(xhr,error){
					 	show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					 	check_submit = 0;
					 }
				 });
			  } else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
			  }
			  });
		}
	}
	
	function edit_dokumen_<?php echo $methodid ?>(dokumen_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_dokumen_detail'
				,param_pop:'db_pop'
				,id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//
				(data[0]);
				//alert(data[0].kode_status);
				$('#form_<?php echo $methodid ?>_dokumen_id').val(data[0].dokumen_id);
				$('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val(data[0].keterangan_dokumen);
				$('#form_<?php echo $methodid ?>_alamat_dok').val(data[0].lokasi_dokumen);
				
			    change_form_<?php echo $methodid ?>_nama_dokumen(data[0].id_nama);
					
				
			   $('.button_<?php echo $methodid ?>_dokumen_edit').show();
			   $('.button_<?php echo $methodid ?>_dokumen_new').hide();	
			}
		});
	}
	
	function delete_dokumen_<?php echo $methodid ?>(dokumen_id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Dokumen ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
			  if (result.value) {
			    page_loading("show",'Delete <?php echo $page_title ?> Dokumen','Please Wait...');
				 $.ajax({
					 url: baseurl+'<?php echo $class_uri ?>/delete_dokumen',								
					 data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',dokumen_id:dokumen_id},
					 dataType: 'json',
					 method: 'post',
					success: function(data){
						page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> dokumen',data.message);			
								$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
								cancel_dokumen_<?php echo $methodid ?>();
								
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
					},
					 error: function(xhr,error){
					 	show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					 	check_submit = 0;
					 }
				 });
			  } else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
			  }
			  });
		}
	}
	

    function cancel_keluarga_<?php echo $methodid ?>(){
	
		$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val('');
		$('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val('');
		$('#form_<?php echo $methodid ?>_keluarga_pendidikan').val('');
		$('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val('');
		$('#form_<?php echo $methodid ?>_keluarga_id').val('');
		
		change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id('5');
		change_form_<?php echo $methodid ?>_keluarga_gender_keluarga('2');
				
		$('.button_<?php echo $methodid ?>_keluarga_edit').hide();
		$('.button_<?php echo $methodid ?>_keluarga_new').show();	
		
		$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
	}	
	
	function cancel_dokumen_<?php echo $methodid ?>(){
	    $('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
							   
	    change_form_<?php echo $methodid ?>_nama_dokumen('10');
					
		 $('.button_<?php echo $methodid ?>_dokumen_edit').hide();
		 $('.button_<?php echo $methodid ?>_dokumen_new').show();	
		
		$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
	}

     function preview_dokumen_<?php echo $methodid ?>(dokumen_id){
		// alert(link_dokumen);
		$.ajax({
			url:baseurl+'<?php echo $class_uri ?>/preview_dokumen',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param_pop:'db_pop'
				,dokumen_id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				//page_loading("hide");
				//console.log(data['lokasi']);
		    $('#gbr_dokumen2').modal('show');
		   $('#modal_gbr').html('<img src="'+ data['lokasi'] + '" class="img-fluid">');
					
			}
		});
		  
		// document.gbr.src='./assets/img/profile/ekonomi Bulolo/dokumen/050957_KTP_1644884239_3b035d0c146004e27195.jpg';
         //document.gbr.width=500;
        //document.gbr.style.display='block';
	   //$('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
		//					   
	   //change_form_<?php echo $methodid ?>_nama_dokumen('10');
		//			
		// $('.button_<?php echo $methodid ?>_dokumen_edit').hide();
		// $('.button_<?php echo $methodid ?>_dokumen_new').show();	
		//
		//$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
	}		
	
	  function download_dokumen_<?php echo $methodid ?>(dokumen_id){
	   //	page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url:baseurl+'<?php echo $class_uri ?>/download_dokumen',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param_pop:'db_pop'
				,dokumen_id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				console.log(data);
					
			}
		});
	
	}		
	/* End Detail Function */
	
	var check_submit = 0;
	function add_list_<?php echo $methodid ?>(rh_id){
		page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
		setTimeout(function(){ 
			var id = jQuery("#table_<?php echo $methodid ?>_purchase_request").jqGrid('getGridParam','selrow');
			if (id) {
				var row = jQuery("#table_<?php echo $methodid ?>_purchase_request").jqGrid('getRowData',id);   
				
				purchase_order_id = $('#form_<?php echo $methodid ?>_purchase_order_id').val();
				purchase_order_detail_id = rh_id;
				purchase_request_detail_id = parseInt(unwrap_cell_value(row.r1).replace(/,/g, ''));
				item_id = parseInt(unwrap_cell_value(row.r19).replace(/,/g, ''));
				quantity_ordered = parseFloat(unwrap_cell_value(row.r12).replace(/,/g, ''));
				uom_id = parseInt(unwrap_cell_value(row.r13).replace(/,/g, ''));
				conversion = parseFloat(unwrap_cell_value(row.r14).replace(/,/g, ''));
				unit_price = parseFloat(unwrap_cell_value(row.r15).replace(/,/g, ''));
				order_delivery_date = unwrap_cell_value(row.r16);
				purchase_order_detail_memo = unwrap_cell_value(row.r17);
				
				$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_detail',
				data: {
					'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
					,purchase_order_detail_id:purchase_order_detail_id
					,purchase_request_detail_id :purchase_request_detail_id
					,purchase_order_id :purchase_order_id
					,item_id :item_id
					,quantity_ordered :quantity_ordered
					,uom_id :uom_id
					,conversion :conversion
					,unit_price :unit_price
					,order_delivery_date :order_delivery_date
					,purchase_order_detail_memo :purchase_order_detail_memo
					,trans_type :2
				},
				dataType: 'json',
				method: 'post',
				success: function(data){
					
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?> Detail',data.message);	
						cancel_detail_<?php echo $methodid ?>();
						$("#table_<?php echo $methodid ?>_purchase_request").trigger('reloadGrid');
						$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
						page_loading("hide");			
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
				
				
			} else {
				show_error("show",'Error','Please select row');
			}
			
		}, 500);	
		
	}
	function simpan_spec_<?php echo $methodid ?>(id){
		if(check_submit == 0) {
			var check_error = 0;
			var error_msg = '';
			
			var myArray = [];
			var arrname = [];
			var select =jQuery('#table_<?php echo $methodid ?>_detail_spec').jqGrid('setSelection','111');
            var id = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getGridParam','selrow');
			// alert(id);
			
			var row = jQuery("#table_<?php echo $methodid ?>_detail_spec").jqGrid('getRowData',id);
			 // alert(row.r4);
			var rowsData = idsOfSelectedRows_<?php echo $methodid ?>_detail_spec;
			var jml=rowsData.length;
			//alert(jml);
		    if (jml==0){
				show_error("show",'Error','Please select data');
				check_submit = 0;
			}
			if (rowsData.length > 1 ){
				show_error("show",'Error','Please one select 1 ');
				check_submit = 0;
			}
			
			for (var i = 0; i < rowsData.length; i++) {
				
				var rowId = rowsData[i];
				var row = $('#table_<?php echo $methodid ?>_detail_spec').jqGrid ('getRowData', rowId);
				 var id_code = unwrap_cell_value(row.r1).replace(/,/g, '');
				 var header_id = unwrap_cell_value(row.r2).replace(/,/g, ''); //header_id
				 //var uraian = unwrap_cell_value(row.r4).replace(/,/g, ''); 
				 var name_spec = unwrap_cell_value(row.r4).replace(/,/g, '');
				// var detail1 = unwrap_cell_value(row.r5).replace(/,/g, '');
				 //var detail2 = unwrap_cell_value(row.r6).replace(/,/g, '');
				  var nilai_spec = unwrap_cell_value(row.r5).replace(/,/g, '').split(" ");
				  let nilai_spec2 = parseFloat(unwrap_cell_value(row.r5).replace(/,/g, ''));
				 var note = unwrap_cell_value(row.r11).replace(/,/g, '');
				// alert(nilai_spec.search("/"));
				//	alert(nilai_spec.match(/^[0-9\/\.]+$/));
				if (nilai_spec.length > 1){
					nilai_spec = nilai_spec2 + toDeci(nilai_spec[1]);
				}else{
					 fraction = nilai_spec.toString();
				     //fraction.search('/')
					 if(fraction.search('/') >=0){
						 nilai_spec =toDeci(nilai_spec[0]);
					 }else{
					    nilai_spec = nilai_spec2;
					 }
				}
			    // alert(nilai_spec);
				  if (nilai_spec2 > 0) {
					//nilai_spec = toDeci('1/2');
						
				 //	myArray.push({'item_id':id_code,'name_spec':name_spec,'detail_1':detail1,'detail_2':detail2,'nilai_spec':nilai_spec,'note':note}); 
					myArray.push({'item_id':id_code,'header_id':header_id,'name_spec':name_spec,'nilai_spec':nilai_spec,'note':note});
				 } 
				
				 
			}
		//	alert(myArray.length);
			  if (myArray.length == 0 ){
				   show_error("show",'Error','Please select 2');
				   check_submit = 0;
				  //alert("error");
			    }else{
			       idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [];
				    var data = {
					   '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',                             
					   isi_data2: myArray
				      };
					//alert(id_code);  
			       $("#table_<?php echo $methodid ?>_detail_spec").jqGrid('setGridParam',{
				        postData: {
				        	'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
				        	 ,'q':'3'
				        	 ,isi_data : myArray
							 ,detail_id : id_code
				        	  } 
			
			        });
					
					// $("#table_<?php echo $methodid ?>_detail_spec").trigger('reloadGrid');
					 $("#table_<?php echo $methodid ?>_detail_spec").trigger("reloadGrid", { fromServer: true, page: 1 });
			         $("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail_spec').width() - 20,true).trigger('resize');
				}
		}
	}
	
	function toDeci(fraction) {
         fraction = fraction.toString();
         var result,wholeNum=0, frac, deci=0;
         if(fraction.search('/') >=0){
             if(fraction.search('-') >=0){
                 wholeNum = fraction.split('-');
                 frac = wholeNum[1];
                 wholeNum = parseInt(wholeNum,10);
             }else{
                 frac = fraction;
             }
             if(fraction.search('/') >=0){
                 frac =  frac.split('/');
                 deci = parseInt(frac[0], 10) / parseInt(frac[1], 10);
             }
             result = wholeNum+deci;
         }else{
             result = fraction
         }
         return result;
    }
	
	function delete_spec_<?php echo $methodid ?>(id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Dokumen ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
			  if (result.value) {
				  alert(id);
				   
			//   page_loading("show",'Delete <?php echo $page_title ?> Dokumen','Please Wait...');
			//	 $.ajax({
			//		 url: baseurl+'<?php echo $class_uri ?>/delete_dokumen',								
			//		 data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',dokumen_id:dokumen_id},
			//		 dataType: 'json',
			//		 method: 'post',
			//		success: function(data){
			//			page_loading("hide");
			//				check_submit = 0;
			//				if(data.valid){
			//					show_success("show",'Delete <?php echo $page_title ?> dokumen',data.message);			
			//					$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
			//					cancel_dokumen_<?php echo $methodid ?>();
			//					
			//					setTimeout(function(){ 
			//						$('.tab_scrollbar').getNiceScroll().resize(); 
			//					}, 100);
			//				} else {
			//					show_error("show",'Error',data.message);
			//				}
			//		},
			//		 error: function(xhr,error){
			//		 	show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
			//		 	check_submit = 0;
			//		 }
			//	 });
			  } else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
			  }
			  });
		}
	}
	
	function simpan_speck_awal_<?php echo $methodid ?>(id){
		if(check_submit == 0) {
			//check_submit = 1;
			
			var check_error = 0;
			var error_msg = '';
			
			var myArray = [];
			var arrname = [];
			var rowsData = idsOfSelectedRows_<?php echo $methodid ?>_detail_spec;
			var jml=rowsData.length;
			
		    if (jml==0){
				show_error("show",'Error','Please select data');
				check_submit = 0;
			}
			if (rowsData.length > 1 ){
				show_error("show",'Error','Please one select ');
				check_submit = 0;
			}
			
			for (var i = 0; i < rowsData.length; i++) {
				
				var rowId = rowsData[i];
				var row = $('#table_<?php echo $methodid ?>_detail_spec').jqGrid ('getRowData', rowId);
				 var id_code = unwrap_cell_value(row.r1).replace(/,/g, '');
				// var name_spec = row.r4;
				 var name_spec = unwrap_cell_value(row.r4).replace(/,/g, '');
				 var detail1 = unwrap_cell_value(row.r5).replace(/,/g, '');
				 var detail2 = unwrap_cell_value(row.r6).replace(/,/g, '');
				 var nilai_spec = parseFloat(unwrap_cell_value(row.r8).replace(/,/g, ''));
				 //alert(name_spec);
				
				// var name_spec = parseFloat(unwrap_cell_value(row.r4).replace(/,/g, ''));
				// var detail1 = parseFloat(unwrap_cell_value(row.r5).replace(/,/g, ''));
				// var detail2 = parseFloat(unwrap_cell_value(row.r6).replace(/,/g, ''));
				// var nilai_spec = parseFloat(unwrap_cell_value(row.r8).replace(/,/g, ''));
				// var note = parseFloat(unwrap_cell_value(row.r12).replace(/,/g, ''));
				// //var idnya = parseFloat(unwrap_cell_value(row.r1).replace(/,/g, ''));
				// 
				// if(quantity_available < quantity_material){
				// 	check_error = 1;
				// 	error_msg = 'Item Code : ' + id_code + ' Quantity insufficient';
				// } 
				// 
				//  if (name_spec !='') {	
				//     arrname.push(name_spec); 
				//   }
				  
				  if (nilai_spec > 0) {
				 //   alert("ada nilai spec");
				 	myArray.push({'item_id':id_code,'name_spec':name_spec,'detail_1':detail1,'detail_2':detail2,'nilai_spec':nilai_spec}); 
				 } 
				
			}
			
		   
			//if (name_spec.length > 1 ){
			//	show_error("show",'Error','Please select is one');
			//	check_submit = 0;
			//}
			
			    if (myArray.length == 0 ){
				   show_error("show",'Error','Please select');
				   check_submit = 0;
				  //alert("error");
			    }else{
					//page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
					idsOfSelectedRows_<?php echo $methodid ?>_detail_spec = [];
				    var data = {
					   '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',                             
					   isi_data2 : myArray
				      };
				  
				  //alert(baseurl+'<?php echo $class_uri ?>/post_add_edit_spec');
				  $.ajax({
					    url: baseurl+'<?php echo $class_uri ?>/post_add_edit_spec',
					    data: {
					           '<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',                             
					           isi_data : myArray
				             },
					    dataType: 'json',
			            method: 'post',
					    success: function(data){
					     //	page_loading("hide");
					     	 alert(data.valid);
					     //	check_submit = 0;
					     //	if(data.valid){
					     //		show_success("show",'<?php echo $page_title ?>',data.message);	
					     //		// idsOfSelectedRows_<?php echo $methodid ?>_detail = [];
					     //		
					     //		// $("#table_<?php echo $methodid ?>_detail_spec").trigger('reloadGrid');
					     //		// cancel_detail_<?php echo $methodid ?>();
					     //		// $("#table_<?php echo $methodid ?>_detail_spec").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
					     //					
					     //	 } else {
					     //		show_error("show",'Error',data.message);
					     //	 }
					       },
					         error: function(xhr,error){
						     show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
						     check_submit = 0;
					       }
				      });
				// console.log(data);
				}
				
			//alert(id);
			
		}
	}
	
	function pictureadd(){
		//var filegbr= $("form_<?php echo $methodid; ?>_link_photo");
		//var filegbr= $("form_1045_link_photo");
		const filegbr= document.getElementById("form_<?php echo $methodid; ?>_link_photo");
		//const namagbr= document.getElementById("form_<?php echo $methodid; ?>_nmficture");
		//const filegbr= document.getElementById("form_1045_link_photo");
		let name=filegbr.files[0].name;
		let fjenis=filegbr.files[0].type;
		let fsize=filegbr.files[0].size;
		const ext=fjenis.split("/").pop().toLowerCase();
		//alert (fsize); 
		if(ext =="jpg" || ext=="jpeg" || ext=="png"){
			//namagbr.value=name
			 //----cek ukuran gambar ---------
			 //1195585
			 if(fsize > 2000000){
			   swal({
				  icon: "warning",
				  title:"Information",
				  text:"Maaf, File terlalu Besar ! Maximum 800KB ",
				  timer:4500
			   });
			   this.value="";
			 }
			
		}else{
			swal({
				icon: "warning",
				title:"Information",
				text:"Format gambar tidak sesuai..",
				timer:4500
			});
		//	$("#nmficture").val("");
			return false;
		}
		      //alert('asssss4');	
		      const gbr=document.querySelector(".gbrphoto");
		      filegbr.textContent = name;
		      
		      const fileimg = new FileReader();
	          fileimg.readAsDataURL(filegbr.files[0]);
		      
		      fileimg.onload = function(e) {
		      	gbr.src = e.target.result;
		      };
			//$("#nmficture").val(name);  
		//	  var file_data = filegbr.prop('files')[0];
		     //var form_data = $('#link_photo').prop('files')[0];
		  //    alert('coba8 ');
		      //console.log(fjenis);
		      //alert('coba2 '+name + " size: " + ext);
	}
	

</script>
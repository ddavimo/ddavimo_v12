<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <style>

        #caja {
          
        }
        #contenedor {
            border: 1px solid black;
            width: 300px;
            height: 200px;
        }


    </style>
</head>
<body>



     <textarea id="messageBody" cols="130" rows="30"></textarea>
<input type="button" value="+" 
onclick="insertAtCaret('messageBody','Clinica ');" />
<input type="button" value="+" 
onclick="insertAtCaret('messageBody','[Plan]');" />
<input type="button" value="+" 
onclick="insertAtCaret('messageBody','[Ejecutiva]');" />

<script>


function insertAtCaret(areaId,text) {
	var txtarea = document.getElementById(areaId);
	var scrollPos = txtarea.scrollTop;
	var strPos = 0;
	var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
		"ff" : (document.selection ? "ie" : false ) );
	if (br == "ie") { 
		txtarea.focus();
		var range = document.selection.createRange();
		range.moveStart ('character', -txtarea.value.length);
		strPos = range.text.length;
	}
	else if (br == "ff") strPos = txtarea.selectionStart;
	
	var front = (txtarea.value).substring(0,strPos);  
	var back = (txtarea.value).substring(strPos,txtarea.value.length); 
	txtarea.value=front+text+back;
	strPos = strPos + text.length;
	if (br == "ie") { 
		txtarea.focus();
		var range = document.selection.createRange();
		range.moveStart ('character', -txtarea.value.length);
		range.moveStart ('character', strPos);
		range.moveEnd ('character', 0);
		range.select();
	}
	else if (br == "ff") {
		txtarea.selectionStart = strPos;
		txtarea.selectionEnd = strPos;
		txtarea.focus();
	}
	txtarea.scrollTop = scrollPos;
}



</script>





    <script>
        const caja = document.querySelector('#caja');
        caja.addEventListener('dragstart', e => {
            console.log('star');
        });
        caja.addEventListener('dragend', e => {
            console.log('end');
        });
        caja.addEventListener('drag', e => {
            console.log('drag');
        });
        const contenedor = document.querySelector('#contenedor');
        contenedor.addEventListener('dragenter', e => {
            console.log('drag enter');
        });
        contenedor.addEventListener('dragleave', e => {
            console.log('drag leave');
        });
        contenedor.addEventListener('dragover', e => {
            e.preventDefault();
            console.log('drag over');
        });
        contenedor.addEventListener('drop', e => {
            console.log('drop');
            contenedor.append("[clinica]");
        });
    </script>
</body>
</html>


<!doctype html>
 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Bootstrap 3 Form Builder</title>
	<link rel="stylesheet" href="css/jquery.ui.theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.ui.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/beautifyhtml.js"></script>
	<style>
	.droppable-active { background-color: #ffe !important; }
	.tools a { cursor: pointer; font-size: 80%; }
	.form-body .col-md-6, .form-body .col-md-12 { min-height: 400px; }
	.draggable { cursor: move; }
	</style>
	<script>
	$(document).ready(function() {
		setup_draggable();

		$("#n-columns").on("change", function() {
			var v = $(this).val();
			if(v==="1") {
				var $col = $('.form-body .col-md-12').toggle(true);
				$('.form-body .col-md-6 .draggable').each(function(i, el) {
					$(this).remove().appendTo($col);
				})
				$('.form-body .col-md-6').toggle(false);
			} else {
				var $col = $('.form-body .col-md-6').toggle(true);
				$(".form-body .col-md-12 .draggable").each(function(i, el) {
					$(this).remove().appendTo(i % 2 ? $col[1] : $col[0]);
				});
				$('.form-body .col-md-12').toggle(false);
			}
		});

		$("#copy-to-clipboard").on("click", function() {
			var $copy = $(".form-body").parent().clone().appendTo(document.body);
			$copy.find(".tools, :hidden").remove();
			$.each(["draggable", "droppable", "sortable", "dropped",
				"ui-sortable", "ui-draggable", "ui-droppable", "form-body"], function(i, c) {
				$copy.find("." + c).removeClass(c);
			})
			var html = html_beautify($copy.html());
			$copy.remove();

			$modal = get_modal(html).modal("show");
			$modal.find(".btn").remove();
			$modal.find(".modal-title").html("Copy HTML");
			$modal.find(":input:first").select().focus();
			
			return false;
		})
		
		
	});
	
	var setup_draggable = function() {
		$( ".draggable" ).draggable({
			appendTo: "body",
			helper: "clone"
		});
		$( ".droppable" ).droppable({
			accept: ".draggable",
			helper: "clone",
			hoverClass: "droppable-active",
			drop: function( event, ui ) {
				$(".empty-form").remove();
				var $orig = $(ui.draggable)
				if(!$(ui.draggable).hasClass("dropped")) {
					var $el = $orig
						.clone()
						.addClass("dropped")
						.css({"position": "static", "left": null, "right": null})
						.appendTo(this);
						
					// update id
					var id = $orig.find(":input").attr("id");
					
					if(id) {
						id = id.split("-").slice(0,-1).join("-") + "-" 
							+ (parseInt(id.split("-").slice(-1)[0]) + 1)
					
						$orig.find(":input").attr("id", id);
						$orig.find("label").attr("for", id);
					}

					// tools
					$('<p class="tools">\
						<a class="edit-link">Edit HTML<a> | \
						<a class="remove-link">Remove</a></p>').appendTo($el);
				} else {
					if($(this)[0]!=$orig.parent()[0]) {
						var $el = $orig
							.clone()
							.css({"position": "static", "left": null, "right": null})
							.appendTo(this);
						$orig.remove();
					}
				}
			}
		}).sortable();
		
	}
	
	var get_modal = function(content) {
		var modal = $('<div class="modal" style="overflow: auto;" tabindex="-1">\
			<div class="modal-dialog">\
				<div class="modal-content">\
					<div class="modal-header">\
						<a type="button" class="close"\
							data-dismiss="modal" aria-hidden="true">&times;</a>\
						<h4 class="modal-title">Edit HTML</h4>\
					</div>\
					<div class="modal-body ui-front">\
						<textarea class="form-control" \
							style="min-height: 200px; margin-bottom: 10px;\
							font-family: Monaco, Fixed">'+content+'</textarea>\
						<button class="btn btn-success">Update</button>\
					</div>\
				</div>\
			</div>\
			</div>').appendTo(document.body);
			
		return modal;
	};
	
	$(document).on("click", ".edit-link", function(ev) {
		var $el = $(this).parent().parent();
		var $el_copy = $el.clone();
		
		var $edit_btn = $el_copy.find(".edit-link").parent().remove();

		var $modal = get_modal(html_beautify($el_copy.html())).modal("show");
		$modal.find(":input:first").focus();
		$modal.find(".btn-success").click(function(ev2) {
			var html = $modal.find("textarea").val();
			if(!html) {
				$el.remove();
			} else {
				$el.html(html);
				$edit_btn.appendTo($el);
			}
			$modal.modal("hide");
			return false;
		})
	});
	
	$(document).on("click", ".remove-link", function(ev) {
		$(this).parent().parent().remove();
	});
			
	</script>
</head>
<body style="background-color: #ddd;">
	<nav class="navbar navbar-default navbar-fixed" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">	
		<a class="navbar-brand" href="#">Bootstrap 3 Form Builder</a>
		</div>
		<form class="navbar-form navbar-left">
		<div class="form-group">	
			<select class="form-control" id="n-columns">
				<option value="1">1 Column</option>
				<option value="2">2 Columns</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary" data-clipboard-text = "testing"
			id="copy-to-clipboard">Copy HTML</button>
		</form>
	</nav>
	<div style="margin-top: -20px;">
		<div class="row">
			<div class="col-md-3" style="padding: 0px 30px 30px 30px; background-color: #fff;">
				<h3>Elements</h3>
				<form role="form">
					<div class="form-group draggable">
						<label for="input-text-1" >Text Input</label>
						<input type="email" class="form-control" id="input-id-1" placeholder="Enter email">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="input-password-1" >Password</label>
						<input type="password" class="form-control" id="input-password-1"
							placeholder="Password">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="select-1" >Select</label>
						<select class="form-control" id="select-1">
							<option value="Option 1">Option 1</option>
							<option value="Option 2">Option 2</option>
							<option value="Option 3">Option 3</option>
						</select>
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="input-file-1" >File input</label>
						<input type="file" id="input-file-1">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="checkbox draggable">
					<label>
						<input type="checkbox"> <span >Check me out</span>
					</label>
					</div>
					<div class="form-group draggable" style="padding-right: 20px;">
						<button type="submit" class="btn btn-default" >Submit</button>
					</div>
				</form>
			</div>
			<div class="col-md-9" style="padding: 30px;">
				<div style="background-color: #fff; border-radius: 5px; padding: 20px; 
						box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175); ">
					<div class="text-muted empty-form text-center" style="font-size: 24px;">Drag & Drop elements to build form.</div>
					<div class="row form-body">
						<div class="col-md-12 droppable sortable">
						</div>
						<div class="col-md-6 droppable sortable" style="display: none;">
						</div>
						<div class="col-md-6 droppable sortable" style="display: none;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
</body>
</html>

<!doctype html>
 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Bootstrap 3 Form Builder</title>
	<link rel="stylesheet" href="css/jquery.ui.theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.ui.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/beautifyhtml.js"></script>
	<style>
	.droppable-active { background-color: #ffe !important; }
	.tools a { cursor: pointer; font-size: 80%; }
	.form-body .col-md-6, .form-body .col-md-12 { min-height: 400px; }
	.draggable { cursor: move; }
	</style>
	<script>
	$(document).ready(function() {
		setup_draggable();

		$("#n-columns").on("change", function() {
			var v = $(this).val();
			if(v==="1") {
				var $col = $('.form-body .col-md-12').toggle(true);
				$('.form-body .col-md-6 .draggable').each(function(i, el) {
					$(this).remove().appendTo($col);
				})
				$('.form-body .col-md-6').toggle(false);
			} else {
				var $col = $('.form-body .col-md-6').toggle(true);
				$(".form-body .col-md-12 .draggable").each(function(i, el) {
					$(this).remove().appendTo(i % 2 ? $col[1] : $col[0]);
				});
				$('.form-body .col-md-12').toggle(false);
			}
		});

		$("#copy-to-clipboard").on("click", function() {
			var $copy = $(".form-body").parent().clone().appendTo(document.body);
			$copy.find(".tools, :hidden").remove();
			$.each(["draggable", "droppable", "sortable", "dropped",
				"ui-sortable", "ui-draggable", "ui-droppable", "form-body"], function(i, c) {
				$copy.find("." + c).removeClass(c);
			})
			var html = html_beautify($copy.html());
			$copy.remove();

			$modal = get_modal(html).modal("show");
			$modal.find(".btn").remove();
			$modal.find(".modal-title").html("Copy HTML");
			$modal.find(":input:first").select().focus();
			
			return false;
		})
		
		
	});
	
	var setup_draggable = function() {
		$( ".draggable" ).draggable({
			appendTo: "body",
			helper: "clone"
		});
		$( ".droppable" ).droppable({
			accept: ".draggable",
			helper: "clone",
			hoverClass: "droppable-active",
			drop: function( event, ui ) {
				$(".empty-form").remove();
				var $orig = $(ui.draggable)
				if(!$(ui.draggable).hasClass("dropped")) {
					var $el = $orig
						.clone()
						.addClass("dropped")
						.css({"position": "static", "left": null, "right": null})
						.appendTo(this);
						
					// update id
					var id = $orig.find(":input").attr("id");
					
					if(id) {
						id = id.split("-").slice(0,-1).join("-") + "-" 
							+ (parseInt(id.split("-").slice(-1)[0]) + 1)
					
						$orig.find(":input").attr("id", id);
						$orig.find("label").attr("for", id);
					}

					// tools
					$('<p class="tools">\
						<a class="edit-link">Edit HTML<a> | \
						<a class="remove-link">Remove</a></p>').appendTo($el);
				} else {
					if($(this)[0]!=$orig.parent()[0]) {
						var $el = $orig
							.clone()
							.css({"position": "static", "left": null, "right": null})
							.appendTo(this);
						$orig.remove();
					}
				}
			}
		}).sortable();
		
	}
	
	var get_modal = function(content) {
		var modal = $('<div class="modal" style="overflow: auto;" tabindex="-1">\
			<div class="modal-dialog">\
				<div class="modal-content">\
					<div class="modal-header">\
						<a type="button" class="close"\
							data-dismiss="modal" aria-hidden="true">&times;</a>\
						<h4 class="modal-title">Edit HTML</h4>\
					</div>\
					<div class="modal-body ui-front">\
						<textarea class="form-control" \
							style="min-height: 200px; margin-bottom: 10px;\
							font-family: Monaco, Fixed">'+content+'</textarea>\
						<button class="btn btn-success">Update</button>\
					</div>\
				</div>\
			</div>\
			</div>').appendTo(document.body);
			
		return modal;
	};
	
	$(document).on("click", ".edit-link", function(ev) {
		var $el = $(this).parent().parent();
		var $el_copy = $el.clone();
		
		var $edit_btn = $el_copy.find(".edit-link").parent().remove();

		var $modal = get_modal(html_beautify($el_copy.html())).modal("show");
		$modal.find(":input:first").focus();
		$modal.find(".btn-success").click(function(ev2) {
			var html = $modal.find("textarea").val();
			if(!html) {
				$el.remove();
			} else {
				$el.html(html);
				$edit_btn.appendTo($el);
			}
			$modal.modal("hide");
			return false;
		})
	});
	
	$(document).on("click", ".remove-link", function(ev) {
		$(this).parent().parent().remove();
	});
			
	</script>
</head>
<body style="background-color: #ddd;">
	<nav class="navbar navbar-default navbar-fixed" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">	
		<a class="navbar-brand" href="#">Bootstrap 3 Form Builder</a>
		</div>
		<form class="navbar-form navbar-left">
		<div class="form-group">	
			<select class="form-control" id="n-columns">
				<option value="1">1 Column</option>
				<option value="2">2 Columns</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary" data-clipboard-text = "testing"
			id="copy-to-clipboard">Copy HTML</button>
		</form>
	</nav>
	<div style="margin-top: -20px;">
		<div class="row">
			<div class="col-md-3" style="padding: 0px 30px 30px 30px; background-color: #fff;">
				<h3>Elements</h3>
				<form role="form">
					<div class="form-group draggable">
						<label for="input-text-1" >Text Input</label>
						<input type="email" class="form-control" id="input-id-1" placeholder="Enter email">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="input-password-1" >Password</label>
						<input type="password" class="form-control" id="input-password-1"
							placeholder="Password">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="select-1" >Select</label>
						<select class="form-control" id="select-1">
							<option value="Option 1">Option 1</option>
							<option value="Option 2">Option 2</option>
							<option value="Option 3">Option 3</option>
						</select>
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="form-group draggable">
						<label for="input-file-1" >File input</label>
						<input type="file" id="input-file-1">
						<p class="help-block">Example block-level help text here.</p>
					</div>
					<div class="checkbox draggable">
					<label>
						<input type="checkbox"> <span >Check me out</span>
					</label>
					</div>
					<div class="form-group draggable" style="padding-right: 20px;">
						<button type="submit" class="btn btn-default" >Submit</button>
					</div>
				</form>
			</div>
			<div class="col-md-9" style="padding: 30px;">
				<div style="background-color: #fff; border-radius: 5px; padding: 20px; 
						box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175); ">
					<div class="text-muted empty-form text-center" style="font-size: 24px;">Drag & Drop elements to build form.</div>
					<div class="row form-body">
						<div class="col-md-12 droppable sortable">
						</div>
						<div class="col-md-6 droppable sortable" style="display: none;">
						</div>
						<div class="col-md-6 droppable sortable" style="display: none;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PayTabs</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>

<div id="container">
	<h1>PayTabs</h1>

	<div id="body">
		<div class="select-container">
			<select class="categories">
					<option disabled selected style="display:none;">Select Category</option>
				<?php foreach($main_categories as $category): ?>
					<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>

</body>
<script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>

<script>
$( document ).ready(function() {
	var BASE_URL = "<?php echo base_url(); ?>";
	
	$(document).on('change', 'select', function () {
		var selected_category = $(this).val();

		$.get(BASE_URL+'Home/get_or_create_categories_by_parent_id/'+selected_category, function(data, status){
			categories = JSON.parse(data);
			$('.select-container').append('<br>');

			var select = $('<select class="categories"></select>');
			
			var o = new Option("Select Category", "0");
			$(o).html("Select Category");
			$(o).attr("style", "display: none;");
			select.append(o);
			
			
            for(var i = 0; i<categories.length; i++){
                var o = new Option(categories[i]['category_name'], categories[i]['category_id']);
                $(o).html(categories[i]['category_name']);
                select.append(o);
            } 		
            $('.select-container').append(select);  
			//$('.select-container').append('</select>');
		});
	});
});
</script>
</html>
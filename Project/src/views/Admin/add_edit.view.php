<?php

use App\Lib\Utils;

require __DIR__ . '/admin_header.inc.view.php';
?>

<main id="content">

	<!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

	<h1><?= Utils::esc($title) ?></h1>

	<form method="POST" id="addEditRecord" enctype="multipart/form-data">
		
		<h2>Basic Infomation</h2>
		<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>" >
		
		<?php foreach ($data['headers'] as $header) : ?>			
			<p>
				<!-- Display labels -->
				<label for="<?= Utils::esc($header) ?>">
					<?= Utils::esc(ucfirst(str_replace("_", " ", $header))) ?>:
				</label>
				<br>
				<!-- Change input to file type for users to upload image -->
				<?php if ($header == 'thumbnail_path') : ?>
					<!--Show image -->
					<?php if ($data['record']) : ?>
						<img src="images/dogs/<?= $data['record'][$header] ?>" 
							 alt="">
						<br>
						<br>
					<?php endif; ?>

					<input name="<?= Utils::esc($header) ?>" type="file">
					<span class="req">
						<?= $errors['thumbnail_path'][0] ?? '' ?>
					</span>
					<br>
				<!-- Change input box to textarea if it is description -->
				<?php elseif ($header == 'description') : ?>
					<!-- sticky value -->
					<?php 
						$row = isset($data['record'][$header]) ? 
						$data['record'][$header] : '';
						$value = isset($_POST[$header]) ? 
						$_POST[$header] : $row 
					?>
					<textarea name="<?= Utils::esc($header) ?>" 
							  id="<?= Utils::esc($header) ?>" 
							  cols="50" 
							  rows="10"><?=Utils::esc($value ?? '')?></textarea>

					<span class="req"><?= $errors[$header][0] ?? '' ?></span>

				<!-- Change input to check box -->
				<?php elseif ($header == 'has_chip' || 
							  $header == 'neutered') : ?>
					<!-- sticky value -->
					<?php 
						$row = isset($data['record'][$header]) && 
							   ('GET' == $_SERVER['REQUEST_METHOD']) ? 
							   $data['record'][$header] : false;
						$value = isset($_POST[$header]) ? 
								 $_POST[$header] : $row; 
					?>
					<input <?= $value ? 'checked' : '' ?> 

					type="checkbox" name="<?= Utils::esc($header) ?>" value="1">
				<!-- Change to select box -->
				<?php elseif ($header == 'gender') : ?>	
					<!-- sticky value -->	
					<?php 
						$row = isset($data['record'][$header]) && 
							   ('GET' == $_SERVER['REQUEST_METHOD']) ? 
							   $data['record'][$header] : '';
						$value = isset($_POST[$header]) ? 
								 $_POST[$header] : $row; 
					?>				
      				<select name="gender" id="gender">      				  
      				    <option value="M" <?=$value == 'M' ? 'selected' : '' ?>>
					  		M
					    </option>
      				    <option value="F" <?=$value == 'F' ? 'selected' : '' ?>>
							F
						</option>      
      				</select>
				<?php else : ?>
					<!-- Otherwise all should be text box -->
					<input name=<?= Utils::esc($header) ?> type="text" 					
						<?php 
						// sticky value
							$row = isset($data['record'][$header]) ? 
							$data['record'][$header] : '';
							$value = isset($_POST[$header]) ? 
							  $_POST[$header] : $row 
						?> 
						value="<?= Utils::esc($value ?? '') ?>"
						<?php if ($header == "dob") : ?>
							placeholder="yyyy-mm-dd"
						<?php elseif($header == "weight") : ?>
							placeholder="Please insert kg"
						<?php elseif($header == "height") : ?>
							placeholder="Please insert cm"
						<?php else : ?>
							placeholder="<?= Utils::esc($header) ?>"
						<?php endif; ?>
					>
					<span class="req"><?= $errors[$header][0] ?? '' ?></span>

					<br>
				<?php endif; ?>
			</p>
		<?php endforeach; ?>
		<!-- End of loop header -->
		<p>
			<label for="images">Images:</label><br>
			<div>
				<?php if ($data['img_record']) : ?>
					<!-- Loop and display every image except thumbnail-->
					<div class="imgsContainer">
						<?php foreach($data['img_record'] as $img) : ?>
							<div class="imgContainer">
								<img src="images/dogs/
									<?= Utils::esc($img['img_path']) ?>" 
									alt="<?= Utils::esc($img['img_path']) ?>"
									width="<?=getimagesize(
											"images/dogs/{$img['img_path']}"
											)[0]/1.5?>"
									height="<?=getimagesize(
											"images/dogs/{$img['img_path']}"
											)[1]/1.5?>">
								<br>	
								<!-- remove image icon -->
								<button class="removeImgs" 
										img_id="<?=Utils::esc($img['img_id'])?>"
										id="<?= Utils::esc($id) ?>" 
										type="button"
										title="Remove Current Image">
									<svg xmlns="http://www.w3.org/2000/svg" 
								  		width="20" 
							  	  		height="20" 
							  	  		fill="currentColor" 
							  	  		class="bi bi-trash-fill" 
							  	  		viewBox="0 0 16 16">
							  	  		<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 
												0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 
												0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1
												 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 
												1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 
												.5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 
												0 1 .5-.5zM8 5a.5.5 0 0 1 
												.5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 
												0 1 8 5zm3 .5v7a.5.5 0 0 1-1 
												0v-7a.5.5 0 0 1 1 0z"/>
									</svg>
								</button>									
							
							</div>
							<!-- End of image container -->
						<?php endforeach ; ?>
					</div>
					<!-- End of all images container -->
				<?php endif; ?>
			</div>
			<!-- end of images div -->
			<br>
			<input id="images" name="images[]" type="file" multiple>
			<span class="req"><?= $errors['images'][0] ?? '' ?></span>
			<br>
		</p>
		<div id="vaccines">
			<h2>Vaccinations</h2>
			<?php foreach($data['vaccines'] as $v) : ?>
				<!-- sticky values -->
				<?php 
					$row = false;
					foreach($data['vac_record'] as $vc){
						if ($vc['vac_id'] == $v['vac_id'] && 
						('GET' == $_SERVER['REQUEST_METHOD'])){
							$row = true;
						}
					}
					$checked = isset($_POST["vac_" . $v['vac_name']]) ? 
								true : $row; 
				?>
				<!-- show all vaccines -->
				<input <?= $checked ? 'checked' : '' ?> 
					  type="checkbox" 
					  name="vac_<?= Utils::esc($v['vac_name']) ?>" 
					  value="<?= Utils::esc($v['vac_id']) ?>">
				<label for="<?= Utils::esc($v['vac_name']) ?>">
					<?= Utils::esc($v['vac_name']) ?>
				</label>
			<?php endforeach ;?>
		</div>
		<!-- end of vaccines div -->
		<p>
			<input type="submit" title="Submit Form" value="Submit" >
			<input type="reset" title="Reset Form" value="Reset" >
		</p>
	</form>

</main>

<?php require __DIR__ . '/admin_footer.inc.view.php'; ?>
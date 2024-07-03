<?php

use App\Lib\Utils;

require __DIR__ . '/admin_header.inc.view.php';
?>

<main id="content">

	<!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

	<h1><?= Utils::esc($title) ?></h1>
	<h2>Aggregate Data</h2>
	<div id="aggregateDataContainer">
		<div id="ani_aggre_data">
			<h3>Animal information</h3>
			<!-- Show adoption aggregate information -->
			<div>
				<?php foreach ($data['ani'] as $key => $value) : ?>
					<?php if ($key != 'breeds' && $key != 'ages') : ?>
						<p>
							<strong>
								<?= Utils::esc(
										ucfirst(
											str_replace("_", ". ", $key)
										)
									) 
								?>
							</strong> :

							<?= Utils::esc($value) ?>
						</p>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<!-- end of key value information-->
			<div id="ani_aggre_charts">
				<!-- animal group by breed -->
				<div id="breeds_chart" class="charts"></div>				
				
				<!-- animal group by age -->
				<div id="ages_chart" class="charts"></div>
				
			</div>
			<!-- end of ani_aggre_tables -->
		</div>
		<!-- end of ani_aggre_data -->

		<div id="adopt_aggre_data">
			<h3>Adoptions information</h3>
			<!-- Show adoption aggregate information -->
			<?php foreach ($data['adopt'] as $key => $value) : ?>
				<?php if ($key != 'status') : ?>
					<p>
						<strong>
							<?= Utils::esc(ucfirst($key)) ?>
						</strong> :

						<?= Utils::esc($value) ?>
					</p>
				<?php endif; ?>
			<?php endforeach; ?>

			<div id="status_chart" class="charts"></div>

		</div>
		<!-- end of adopt_aggre_data -->

		<div id="users_aggre_data">
			<h3>Users information</h3>
			<!-- Show users aggregate information -->
			<?php foreach ($data['users'] as $key => $value) : ?>
				<p>
					<strong>
						<?= Utils::esc(ucfirst($key)) ?>
					</strong> :

					<?= Utils::esc($value) ?>
				</p>
			<?php endforeach; ?>

			<div id="users_chart" class="charts"></div>
		</div>
		<!-- end of users_aggre_data -->

	</div>
	<!-- end of aggregateDataContainer -->

	<br>
	<hr>
	<h2>Recent Log</h2>
	<table id="logs_table">

		<!-- Start of table header -->
		<thead>
			<tr>
				<th>id</th>
				<th>Event</th>
			</tr>
		</thead>
		<!-- End of table header -->
		<tbody>
			<?php for ($i = 0; $i < count($logs); $i++) : ?>				
				<tr>
					<td><?= Utils::raw($i + 1) ?></td>
					<td><?= Utils::esc($logs[$i]['event'] ?? $logs[$i]) ?></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
	<!-- end of log table -->

</main>

<?php require __DIR__ . '/admin_footer.inc.view.php'; ?>
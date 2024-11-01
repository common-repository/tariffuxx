<?php
/**
 * @var int $step
 */

$hasConfigDataId = isset($config_data->id) && !empty($config_data->id);
$configDataId = true === $hasConfigDataId ? $config_data->id : 0;
?>
<div class="z-depth-1 m-2">
	<div class="row">
		<div class="col-md-12">
			<ul class="stepper stepper-horizontal my-0">
				<li class="<?php echo ($step == 1 && $hasConfigDataId) ? 'current' : 'inactive' ?> col-sm">
					<a href="javascript:void(0)" class="<?php echo $hasConfigDataId ? 'is_disabled' : '' ?>">
						<span class="circle"><i class="fa fa-star"></i></span>
						<span class="label">1. Erstellen</span>
					</a>
				</li>
                <?php
                    $step_class = "inactive";
                    if ($step == 2) {
	                    $step_class = 'current';
                    } else if ($hasConfigDataId) {
	                    $step_class = 'active';
                    }
                ?>
				<li class="<?php echo esc_attr($step_class) ?> col-sm">
					<a href="<?php echo esc_url($hasConfigDataId ? "/wp-admin/admin.php?page=tariffuxx_twl&twl_id=$configDataId&step=2" : "") ?>">
						<span class="circle"><i class="fa fa-cogs"></i></span>
						<span class="label">2. Konfigurieren</span>
					</a>
				</li>
				<?php
				$step_class = "inactive";
				if ($step == 3) {
					$step_class = 'current';
				} else if ($hasConfigDataId) {
					$step_class = 'active';
				}
				?>
				<li class="<?php echo esc_attr($step_class) ?> col-sm">
					<a href="<?php echo esc_url($hasConfigDataId ? "/wp-admin/admin.php?page=tariffuxx_twl&twl_id=$configDataId&step=3" : "") ?>">
						<span class="circle"><i class="fa fa-code"></i></span>
						<span class="label">3. Einbinden</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php if (!isset($_GET['tipo'])): ?>
          	<div>
              <button class="btn btn-lg btn-primary btn-block" name="btnEst" type="submit" style="width: 100%;position: initial;">Estudiante</button> <button class="btn btn-lg btn-primary btn-block" name="btnFun" type="submit" style="width: 100%;position: initial; ">Funcionario</button>  
				
			</div> 
          <?php else: ?>

          	<?php if (($_GET['tipo'])==1): ?>
          		<center> <button class="btn btn-lg btn-primary btn-block" name="btnEst" type="submit" style="width: 350px;">Registrarse</button>   </center>
          	<?php elseif (($_GET['tipo'])==2): ?>
          		<center> <button class="btn btn-lg btn-primary btn-block" name="btnFun" type="submit" style="width: 350px;">Registrarse</button>  </center>
          <?php elseif ($_GET['tipo'] == 0): ?>
          		<button class="btn btn-lg btn-primary btn-block" name="btnEst" type="submit" style="width: 100%;position: initial;">Estudiante</button> <button class="btn btn-lg btn-primary btn-block" name="btnFun" type="submit" style="width: 100%;position: initial; ">Funcionario</button>  
          
         <?php endif ?><?php endif ?>
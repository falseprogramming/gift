
			<div id="order-content">
					<div id='first-content'>
			<form method='post' action='index.php?p=doPdf'>
				<div class="controls">
					<span><?php echo $labelET['Choose template'];?></span><br>
					<select id="selectDesign" name='selectDesign'>
						<option value="default">Tavaline </option>
						<option value="birthday">Sünnipäev</option>
						<option value="love">Armastus</option>
						<option value="friend">Sõber</option>
					</select>
				</div><!-- /.controls-->
				<span><?php echo $labelET['Form fill text'];?></span><br>
				<label><?php echo $labelET['Price'];?>
					<input type="text" class="giftTextField" name='price' value='10'  id="priceIn">Eur
				</label>
				<br>
				<label><?php echo $labelET['Name'];?>
					<input type="text" class="giftTextField" id="name" name='name'>
				</label>
						<br>
						<label><?php echo $labelET['To mail'];?>
					<input type="text" class="giftTextField" id="to-mail" name='to-mail'>
					</label>
						<br>
						<div id='sender-nameDIV'>
						<label><?php echo $labelET['Sender name'];?>
					<input type="text" class="giftTextField" id="sender-name" name='sender-name'>
					</label>
					</div>
						<div id='sender-mailDIV'>
						<label><?php echo $labelET['Sender mail'];?>
					<input type="text" class="giftTextField" id="sender-mail" name='sender-mail'>
				</label>
				</div>
						
					
			
				<label><?php echo $labelET['Message']?>
					<textarea  id="message" name='message'></textarea><br><span class='counter'>30</span><span> <i>tähte jäänud</i></span>
					</label>
				<br>
				<input type='hidden' id='uid' name='uid' readonly="true" value='<?php echo uniqid();?>'>
				<input type='submit' class='btn' id='send' value='Saada'>
				<!--<input type='button' class='btn' id='next' value='Next'>-->
				</div>
				
				<!--
				<div id='next-content'>
				
				<?php require 'templates/forms/send_form.php'; ?>
				
				</div>
				-->
				
			</form>
		<!--
			<button id="save">
				<?php echo $labelET['Save button'];?>
			</button>
		-->
			<div class="arrow"></div><!-- /.arrow-->
		</div><!-- /.order-content-->
<form id="oform">
	<div class="g-row">
		<div class="g-col g-col--one-half">
			<div class="g-fieldset">
				<label class="g-label"><?php pll_e( 'Your name' ); ?>*</label>
				<input type="text" class="g-input js-validate js-validate--required" placeholder="Як Вас звати?" name="of_name" id="of_name" required />
				<span class="g-fieldset__msg">Заповніть це поле!</span>
			</div>
		</div>
		<div class="g-col g-col--one-half">
			<div class="g-fieldset">
				<label class="g-label"><?php pll_e( 'Your email' ); ?>*</label>
				<input type="email" class="g-input js-validate js-validate--email" placeholder="Щоб відповісти Вам. Спаму не буде" name="of_mail" id="of_mail" required />
				<span class="g-fieldset__msg">Вкажіть коректний email!</span>
			</div>
		</div>
	</div>
	<div class="g-row">
		<div class="g-col g-col--one-half">
			<div class="g-fieldset">
				<label class="g-label"><?php pll_e( 'Service name' ); ?></label>
				<select class="g-select" name="of_service" id="of_service">
					<option>Медичний супровід</option>
					<option>Курс першої допомоги</option>
					<option>Інше</option>
				</select>
			</div>
		</div>
		<div class="g-col g-col--one-half">
			<div class="g-fieldset">
				<label class="g-label"><?php pll_e( 'Your phone' ); ?>*</label>
				<input type="text" class="g-input js-validate js-validate--phone" placeholder="Щоб ми могли швидше відповісти Вам" name="of_phone" id="of_phone" />
				<span class="g-fieldset__msg">Вкажіть коректний номер!</span>
			</div>
		</div>
	</div>

	<div class="g-fieldset">
		<label class="g-label"><?php pll_e( 'Message' ); ?></label>
		<textarea class="g-textarea" name="of_msg" id="of_msg"></textarea>
	</div>
	
	<div class="g-recaptcha" data-sitekey="6LcywA0UAAAAAN7n34LJIPVywAXxQyNCzfiyiB5w"></div>

	<div class="g-alert g-alert--ok">
		<p><?php pll_e( 'Message sent' ); ?></p>
		<p><?php pll_e( 'We will contact you' ); ?></p>
		<button type="button" class="g-alert__close">
			<i class="icon-close"></i>
		</button>
	</div>
	<div class="g-alert g-alert--wrong">
		<p><?php pll_e( 'An error has occurred' ); ?></p>
		<p><?php pll_e( 'Message not sent' ); ?></p>
		<p><?php pll_e( 'Please try again later' ); ?></p>
		<button type="button" class="g-alert__close">
			<i class="icon-close"></i>
		</button>
	</div>

	<button type="submit" class="g-btn g-btn--large"><?php pll_e( 'Send a message' ); ?></button>
	<p></p>
</form>

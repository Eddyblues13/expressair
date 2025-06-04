<div class="footer w3-white">
	<div class="w3-bar w3-white">
		<center>
			<table>
				<tr>
				

				
					<td style="font-size:9pt;text-align:center;">
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
								<img src="{{ asset('user/icon/exchange.png') }}"
									style="width:20px;height:20px"><br>Logout
							</button>
						</form>
					</td>


				</tr>
			</table>
		</center>


	</div>
</div>
</div>
</div>






<!--   Core JS Files   -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{asset('user/account/dash/js/core/popper.min.js')}}"></script>
<script src="{{asset('user/account/dash/js/core/bootstrap.min.js')}} "></script>
<script src="{{asset('user/account/dash/js/customs.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('user/account/dash/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('user/account/dash/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('user/account/dash/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js ')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('user/account/dash/js/plugin/jquery.sparkline/jquery.sparkline.min.js ')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('user/account/dash/js/plugin/sweetalert/sweetalert.min.js ')}}"></script>
<!-- Bootstrap Notify -->
<script src="{{asset('user/account/dash/js/plugin/bootstrap-notify/bootstrap-notify.min.js ')}}"></script>

<script type="text/javascript"
	src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js')}}">
</script>
<script type="text/javascript"
	src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js">
</script>
<script src="{{asset('user/account/dash/js/atlantis.min.js')}}"></script>
<script src="{{asset('user/account/dash/js/atlantis.js')}}"></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
<script type="text/javascript">
	function googleTranslateElementInit() {
			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
			}
</script>
</body>

</html>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Vökuró</title>
		<link href="//netdna.bootstrapcdn.com/bootswatch/2.3.1/united/bootstrap.min.css" rel="stylesheet">
		{{ stylesheet_link('css/style.css') }}

        {{ assets.outputCss('css') }}

	</head>
	<body>

		{{ content() }}

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

        {{ assets.outputJs('js') }}
        {{ assets.outputInlineJs('main') }}
        {{ assets.outputInlineJs('script') }}

		<div id="dialog" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="notifier"></div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 id="dialogHeader" class="modal-title">Modal title</h4>
					</div>

					<div class="modal-body">
						<p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer">
						<div class="actions"></div>
						<button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button id="btnOk" type="button" class="btn green">Ok</button>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
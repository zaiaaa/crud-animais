</main> <!-- /container -->

	<hr>
	<footer class="container">
        <?php $hoje = new Datetime("now", new DatetimeZone("America/Sao_Paulo")); ?>
		<p>&copy;2023 a <?php echo $hoje->format("Y") ?>- Projeto PW - Gustavo Zaia e Moisés</p>
	</footer>

    <script src="<?php echo BASEURL; ?>js/jquery-3.7.0.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/popper.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>

    <script src="<?php echo BASEURL; ?>js/main.js"></script>
</body>
</html>
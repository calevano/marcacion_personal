        <?php
        $id_rol     = $this->session->userdata('userIdRol');
        $id_login   = $this->session->userdata('idUserLogin');
        if ($id_login): ?>
        </section>
        <footer id="footer">Copyright &copy; <?php echo date('Y') ?> Carlos Levano and Nick Palomino</footer>
        <?php echo put_headersJs() ?>
        <?php endif; ?>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <?php if ($id_login):  ?>
        <script src="<?php echo base_url('assets/js/global.js') ?>"></script>
        <?php endif; ?>
        <?php echo put_headersJs_() ?>
        <script src="<?php echo base_url('assets/js/plugins/jquery.nicescroll/jquery.nicescroll.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/waves/waves.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/growl/bootstrap-growl.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/functions.js') ?>"></script>
    </body>
</html>

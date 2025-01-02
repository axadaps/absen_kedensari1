<?php
$context = $ctx ?? 'dashboard';
switch ($context) {
   case 'absen-siswa':
   case 'siswa':
   case 'kelas':
      $sidebarColor = 'purple';
      break;

   default:
      $sidebarColor = 'azure';
      break;
}
?>
<div class="sidebar" data-color="<?= $sidebarColor; ?>" data-background-color="black" data-image="<?= base_url('assets/img/sidebar/sidebar-1.jpg'); ?>">
   <div class="logo">
      <a class="simple-text logo-normal">
         <b>Operator<br>Petugas Absensi</b>
      </a>
   </div>
   <div class="sidebar-wrapper">
      <ul class="nav">
         <li class="nav-item <?= $context == 'dashboard' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
               <i class="material-icons">dashboard</i>
               <p>Dashboard</p>
            </a>
         </li>
         <li class="nav-item <?= $context == 'absen-siswa' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/absen-siswa'); ?>">
               <i class="material-icons">checklist</i>
               <p>Absensi Siswa</p>
            </a>
         </li>
         <li class="nav-item <?= $context == 'siswa' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/siswa'); ?>">
               <i class="material-icons">person</i>
               <p>Data Siswa</p>
            </a>
         </li>
         <li class="nav-item <?= $context == 'kelas' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">
               <i class="material-icons">school</i>
               <p>Data Kelas</p>
            </a>
         </li>
         <li class="nav-item <?= $context == 'laporan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/laporan'); ?>">
               <i class="material-icons">print</i>
               <p>Generate Laporan</p>
            </a>
         </li>
         <?php if (session('is_superadmin') ?? '0' == '1') : ?>
            <li class="nav-item <?= $context == 'petugas' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/petugas'); ?>">
                  <i class="material-icons">computer</i>
                  <p>Data Petugas</p>
               </a>
            </li>
            <li class="nav-item <?= $context == 'general_settings' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/general-settings'); ?>">
                  <i class="material-icons">settings</i>
                  <p>Pengaturan</p>
               </a>
            </li>
         <?php endif; ?>
         <!-- <li class="nav-item active-pro mb-3">
            <a class="nav-link" href="./upgrade.html">
               <i class="material-icons">unarchive</i>
               <p>Bottom sidebar</p>
            </a>
         </li> -->
      </ul>
   </div>
</div>
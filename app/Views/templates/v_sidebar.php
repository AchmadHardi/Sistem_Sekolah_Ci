 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate">
             <i class="fas fa-school"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Project New</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="<?= base_url(); ?>">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Member
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="<?= base_url('siswa'); ?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Data Siswa</span>
         </a>
     </li>
     <li class="nav-item">
         <a class="nav-link collapsed" href="<?= base_url('guru'); ?>">
         <i class="fas fa-chalkboard-teacher"></i>
             <span>Data Guru</span>
         </a>
     </li>
 </ul>
 <!-- End of Sidebar -->

 <!-- Button trigger modal -->

 <!-- Modal -->
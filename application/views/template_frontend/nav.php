<style type="text/css">
 
input#search-query {
    padding-left:26px;
        border-radius: 24px;
}

form.form-search {
    position: relative;
}

form.form-search:before {
    content:'';
    display: block;
    width: 14px;
    height: 14px;
    background-image: url(http://getbootstrap.com/2.3.2/assets/img/glyphicons-halflings.png);
    background-position: -48px 0;
    position: absolute;
    top:8px;
    left:8px;
    opacity: .5;
    z-index: 1000;
}
</style>

<section class="banner" role="banner">
  <header id="header">
    <div class="header-content clearfix"> 
      <a class="logo" href="index.php">Logo Campany</a>
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
		      <li><a href="#banner">Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#content-3-10">About</a></li>
          <li><a href="#gallery">Gallery</a></li> 
          <!-- 
          <li><a href="#teams">Our Team</a></li>
          <li><a href="#testimonials">Testimonials</a></li> -->
          <li><a href="#contact">Contact</a></li>
          <li style="    margin-left: 20px;
"><form class="form-search form-inline">
     <input type="text" id="search-query" class="form-control" placeholder="Search..." />
</form></li>
        </ul>

      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
	  <ul>
        <li><img src="/assets/theme_2013/images/img-user-icon.png" alt=" ">welcome, <?php echo check_user_admin()->name;?>!</li>
        <li><img src="/assets/theme_2013/images/img-notification-icon.png" alt=" "><a href="#">notifications (37)</a></li>
        <li><img src="/assets/theme_2013/images/img-close-icon.png" alt=" "><a href="/<?php echo $this->uri->segment(1)."/login/logout";?>">Logout</a></li>
      </ul>
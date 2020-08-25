<?php

 include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

  if (empty($user_id)) {
  header("location: index.php");
  exit;
 }

 include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';


  //links
  $sql ="SELECT s_links.* , s_playlists.name  FROM s_links 
  LEFT JOIN s_playlists ON s_playlists.id = s_links.playlist_id 
  WHERE s_links.user_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([ $user_id ]);
  $links = $stmt->fetchall();

  //playlists
  $sql ="SELECT * FROM s_playlists WHERE user_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([ $user_id]);
  $playlists = $stmt->fetchall();
  $count_playlists = $stmt->rowCount();

  $currentDate = date('Y-m-d\Th:i');
  $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
  $tomorrow = date('Y-m-d\Th:i' , $tomorrow);

?>

<div class="container text-right" style="direction: rtl;">

 <?php 
  //include 'includes/subMenu.php'; 
 ?>

  <?php if( $count_playlists == 0 ): ?>
    <div class="alert alert-warning text-center py-5 border">
      <i class="fas fa-plus  fa-3x animate__animated animate__flash animate__slower animate__infinite"></i>
      <p>
        يلزم  اولا انشاء قائمة تشغيل  واحدة علي الاقل  تقوم فيها بأضافة   الفديوهات  
        <a href="/safety/playlist/createPlaylist.php"> من هنا </a>
      </p>
    </div>
  <?php endif; ?>

 <div class="row" >
  <div class="col">

   <h1 class="m-4 font-weight-bold text-secondary">
      قائمة  فديوهاتك  المحمية 
   </h1>

     <?php $i = 1; foreach ($links as $link ) : ?>

      <div class="row border-bottom my-1" style="direction: rtl">
        
        <div class="col-2 p-0">
          <img  style = "width: 100%" src = 'https://img.youtube.com/vi/<?= get_youtube_id( $link['link'] ) ?>/0.jpg'  >
        </div>
        
        <div class="col">
          
          <h1 class="m-0" style="font-size: 22px">
            <a href = "<?= $domain . $root . '/link/link.php?l=' . $link['id']  ?>" class = "text-dark">
              <?=  $link['title'] ?>
            </a>
          </h1>
          
          <small class="text-muted" style="font-size: 14px;">

            <?php if( $link['is_time_limited'] == "on" ):  ?>
              <span class="badge badge-primary z-depth-0 ">
                <i class="far fa-clock"></i> 
                 محدد بوقت  
              </span> 
            <?php endif; ?>

            <?= $link['description'] ?>  

          </small>
          
          <p class="" style="font-size: 18px">

            <?php if( $link['privacy'] == "private" ):  ?>
              <span class="badge badge-danger z-depth-0 rounded py-1"> 
                <i class="fas fa-lock"></i> 
              </span> . 
            <?php endif; ?>

            <?php if( !empty($link['name']) ):  ?>
              <i class="fas fa-list-alt text-muted"></i>  
              <?= $link['name'] ?> . 
            <?php endif; ?>

             <?php 

              //link who from countacts view count 
              $sql ="SELECT * FROM s_contact_views 
               WHERE link_id = ?  AND pc_visits + phone_visits > 0 ";
               $stmt = $pdo->prepare($sql);
               $stmt->execute([ $link['id'] ]);
               $contact_count = $stmt->rowCount();
               echo $contact_count . ' <i class="fas fa-users text-muted" style="font-size: 14px" ></i> . ' ;
             ?>
            
            <a href = "<?= $domain . $root . '/link/contactsViews.php?l=' . $link['id'] ?>" class = "text-left"> 
              
              الاحصائيات 
            </a>

            <a href = "<?= $domain . $root . '/link/editeLink.php?l=' . $link['id'] ?> " class = "text-left"> 
                 . 
               تعديل  
            </a>


          </p>

        </div>

      </div>
    
    <?php $i++; endforeach; ?>

  </div>

 </div>

 <!--creat link  -->
 <div class=" row">

  <div class="col-12">
         <h1 class="m-4 font-weight-bold text-secondary">
          اضافة فديو جديد
         </h1>
        </div>

        <div class="col-12 col-sm-6 bg-muted rounded py-2">
            <form id="add-link-form" action="#" method="post"  >
            
              <div class="form-group">
                <label for = "link"> 
                      رابط الفديو يوتيوب 
                    </label>
                    <input type="text"  class="form-control" id = "link"  name = "link" placeholder="مثال : https://www.youtube.com/video" required>
                    <small class="text- muted">
                       *تاكد انك قمت بجعل الفديو "غير مدرج " في اعدادات خصوصيه الفديو علي يوتيوب
                    </small>
                </div>

                <div class="form-group">
                 <label for = "title"> 
                     اﻟﻌﻨﻮاﻥ
                    </label>
                    <input type="text"  class="form-control" id = "title"  name = "title" placeholder="ﻣﺎﺫا ﻳﺤﺘﻮﻱ ﻫﺬا  اﻟﻔﺪﻳﻮ" required>
                </div>

                <div class="form-group">
                  <label for = "description"> 
                     اﻟﻮﺻﻒ
                    </label>
                    <input type="text"  class="form-control" id = "description"  name = "description">
                </div>
                
                <div class="form-group">
                   <label> 
                     الخصوصية
                    </label>

                    <select name="privacy" class="custom-select">
                     <option value="available_for_all" selected>
                      متاح لكل جهات الاتصال 
                     </option>
                     <option value="private">
                      خاص   بي - غير مرئي في القناة 
                     </option>
                    </select>

                </div>
                

                <div class="form-group">
                     <label> 
                        اضف الي قائمة تشغيل   ( دورة تعليمية )
                    </label>

                    <select name="playlist_id" class="custom-select" value="<?= $link['privacy'] ?>" required>

                        <?php foreach( $playlists as $playlist ): ?>
                        
                            <option value="<?= $playlist['id'] ?>" >
                                <?= $playlist['name'] ?>    
                            </option>

                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group">
                    <label for = "title"> 
                        عدد المشاهدات المسموح  به 
                    </label>
                    <input type="number"  class="form-control"  name = "allowed_views" value="4" placeholder="" required>
                </div>

                <div class="custom-control custom-checkbox" style="direction: rtl;">
                  <input type="checkbox" class="custom-control-input"  name = "is_time_limited" id="is_time_limited">
                  <label class="custom-control-label"  for="is_time_limited">
                  ﺗﺤﺪﻳﺪ ﺑﻮﻗﺖ 
                  </label>
                </div>

                <div class="form-group time-limit-inputs" style="display: none">
                  <label > 
                     هذا الفديو متاح  للمشاهدة من تاريخ :
                    </label>

                    <input type="datetime-local"  class="timer form-control"  name = "start_date" value="<?= $currentDate ?>" disabled>

                  <label > 
                     حتي تاريخ  : 
                    </label>

                    <input type="datetime-local"  class="timer form-control"  name = "end_date" value="<?= $tomorrow ?>" disabled>
                </div>

                <button type="submit" name="add_link"  class="btn btn-secondary rounded form-control z-depth-0 p-2">
                 اﻧﺸﺎء
                </button>
            </form>
        </div>
        <div class=" col-12 ">
         <div id="new-link-container"></div>
        </div>
    </div><!-- /create link  -->

</div>


<?php

 include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>


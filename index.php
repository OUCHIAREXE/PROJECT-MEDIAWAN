<!DOCTYPE html>
<html lang="ar">

<head>
  <meta name="description" content="--" />
  <meta charset="utf-8">
  <title>MEDIAWAN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <link rel="stylesheet" href="css/style.css">
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Changa:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .gradient-custom { /* fallback for old browsers */ background: #4facfe; /* Chrome 10-25,
Safari 5.1-6 */ background: -webkit-linear-gradient(to bottom right, rgba(79, 172, 254,
1), rgba(0, 242, 254, 1)); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+,
Safari 7+ */ background: linear-gradient(to bottom right, rgba(79, 172, 254, 1), rgba(0,
242, 254, 1)) }
  </style>
</head>

<body style="
    background: linear-gradient(90deg, rgba(26,26,50,1) 22%, rgba(46,45,89,1) 100%);
"> 
<div class="scrollbar" id="style-1">
  <div class="force-overflow"></div>
</div>
<?php
include('./config.php');
session_start();
if (isset($_SESSION["rendez-vous"])) {
  $button_s = '<button type="button"  class="btn btn-custom" style="  background-color:#8bc34a;color:#fff;margin-right: 51px;margin-top: 5px;zoom:0.8;animation:heartBeat;animation-duration: 0.9s; animation-iteration-count: 3;"> تم حجز الموعد</button>';
} else {
  $button_s = '<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-custom" style="  background-color:#5555af;color:#fff;margin-right: 51px;margin-top: 5px;zoom:0.8;animation:heartBeat;animation-duration: 0.9s; animation-iteration-count: 3;">إحجز مكالمتك الأن</button>';

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $country_code = "+212";
  $phone =  $country_code. $_POST['phone'];
  $date = date("d-m-Y");

  if (empty($email) || empty($fullname) || empty($phone)  ) {
    //error message

    header('Location: ?r=0');
  } else {
    $sql = "INSERT INTO mediawan (fullname, email, phone, date)
    VALUES ('$fullname', '$email',  '$phone', '$date')";
    
    if ($conn->query($sql) === TRUE) {
      $_SESSION["rendez-vous"] = "1";
      header('Location: ?r=1');
    
    } else {
    
    }
    
    $conn->close();

  }
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="reservecall_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="float: right;text-align: initial;direction: rtl;font-family: 'Changa', sans-serif;">
        <h5 class="modal-title"  id="reservecall_label">حجز مكالمة</h5>
       
      </div>
      <div class="modal-body" style="float: right;direction: rtl;text-align: initial;font-family: 'Tajawal', sans-serif;">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <div class="form-group">
            <label for="fullname">الاسم الكامل</label>
            <input type="text" name="fullname" class="form-control" id="fullname_input" >
            <small id="privacy_help" class="form-text text-muted">المعطيات تبقى خصوصية لا نقوم بمشاركتها مع اي جهة خارجية</small>
          </div>
          <div class="form-group">
            <label for="email">البريد الالكتروني</label>
            <input type="text" name="email" class="form-control" id="email_input" >
          </div>
          <div class="form-group">
            <label for="fullname">رقم الهاتف </label>
            <div class="input-group mb-3" style="
            direction: ltr;
        ">
              <span class="input-group-text" id="basic-addon3">+212</span>
              <input name="phone"  type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <small id="privacy_help" class="form-text text-muted">سنقوم بالاتصال بك من خلال رقم الهاتف </small>
          </div>
         
       
     
        
      </div>
      <div class="modal-footer">
        <button type="button" style="font-family: 'Tajawal', sans-serif;" class="btn btn-secondary" data-dismiss="modal">العودة</button>
        <button type="submit" class="btn btn-custom" style="font-family: 'Tajawal', sans-serif;background-color: #5555af;
        color: #fff;">حجز المكالمة</button>
           </form>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light " style="direction:rtl;zoom:1mix-blend-mode;animation: fadeIn;animation-duration: 0.8s;position: sticky;top: 0;width: 100%;
background: linear-gradient(90deg, rgba(26,26,50,1) 22%, rgba(46,45,89,1) 100%);
;z-index: 9;height: 53px;">
        <a class="navbar-brand" id="logo_1" href="#" style="font-family: 'Montserrat', sans-serif;color:#fff;animation: glow 2s ease-in-out infinite;" >MEDIAWAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style=" margin: 21px;">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" id="hover-underline-animation" style="color:#fff;" href="#about_us">خدماتنا</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" id="hover-underline-animation" style="color:#fff;" href="#our_philosophy">فلسفتنا</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="hover-underline-animation" style="color:#fff;" href="#">نتائج عملائنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="hover-underline-animation" style="color:#fff;" href="#">أسئلة شائعة</a>
              </li>
             
              <li class="nav-item">
<?php echo $button_s ?>
            </li>
              
              
          </ul>
         
        </div>
      </nav>
      <section id="section_1" style="animation: fadeInLeft;animation-duration: 2s;">
      <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img style="margin-left: 71px;animation:pulse;animation-duration:2s;animation-iteration-count: 10;" class="img-fluid" src="img\1.png" class="d-block mx-lg-auto img-fluid" alt="" width="700" height="500">
          </div>
          <div class="col-lg-6" >
            <h1 class="display-5 fw-bold lh-1 mb-3" style="font-family: 'Changa', sans-serif;text-align: initial;direction:rtl;color:#fff;">الأن حول تجارتك الالكترونية الى اكثر من <a style="color:#db574f; text-shadow: #db574f 0 0 4px;">6 ارقام في الشهر</a></h1>
            <p class="lead" style="text-align: initial;direction: rtl;color:#fff;font-family: 'Tajawal', sans-serif;">اذا كنت تمتلك مشروع خاص مشروع خاص بالتجارة الالكترونية او علامة تجارية مهمتنا هي مساعدتك لتحقيق اعلى عائدات بفضل خبرة فريقتنا المتميز في كل ما يخص التسويق الكتروني في مجال التجارة الالكترونية توقف عن اسراف الاموال الطائلة في حملات اعلانية لا تجلب لك النتائج إحجز مكالمتك الان مع فريفنا ليساعدك</p>
            <div class="">
             <center>
             <button type="button" class="btn btn-custom" style="background-color:#5555af;color:#fff;font-family: 'Tajawal', sans-serif;position: relative; margin: auto;    zoom: 0.8;
    margin-top: 17px;">إحجز مكالمتك الأن</button>
    </center>
            </div>
          </div>
        </div>
        <div id="about_us" anchor></div> 
      </div>
      
    </section>
    <br/> <br/>
    <section id="about_us" style="direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;animation: fadeInLeft;animation-duration: 2.5s;">
      <div class="abt_us" style="
        padding: 23px;
    ">
  <div class="abt_us">
    <div class="abt_us-body">
   <div class="section_title"><h1 id="sec">ما هي الخدمات التي تقدمها </h1><h1 href="#" style="font-family: 'Montserrat', sans-serif;color:#fff;">MEDIAWAN</h1></div>
   <br/>        
   <p style="direction: rtl; float: right; text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;">
    MEDIAWAN يتخصص فريق
    : في تطوير تجارتك الإلكترونية عن طريق
    
    العمل على الإستراتيجيات الموازية مع أهدافك للتسويق منتجك او خدمتك
    و استقطاب الجمهور المناسب لك و ذلك بهدف توسيع نطاق وجودك الإلكتروني بإستعمال أحدث و أفضل الأدوات و الخدمات لتحقيق النتائج التي تريدها
    </p>
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        
        </div>
    </div>

    <div class="row" style="        font-family: 'Changa', sans-serif;">
        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
            <div class="card service-wrapper rounded border-0 shadow p-4">
                <div class="icon text-center text-custom h1 shadow rounded bg-white">
                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg></span>
                </div>
                <div class="content mt-4">
                    <h5 class="title">انشاء الاعلانات</h5>
                    <p class="text-muted mt-3 mb-0" style="    font-family: 'Tajawal', sans-serif;">إنشاء و إدارة الإعلانات على مختلف المنصات</p>
                    
                </div>
                <div class="big-icon h1 text-custom">
                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
          <div class="card service-wrapper rounded border-0 shadow p-4">
              <div class="icon text-center text-custom h1 shadow rounded bg-white">
                  <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                  </svg></span>
              </div>
              <div class="content mt-4">
                  <h5 class="title">انشاء صفحات الويب</h5>
                  <p class="text-muted mt-3 mb-0" style="    font-family: 'Tajawal', sans-serif;">إنشاء المواقع و صفحات الهبوط المناسبة لمنتجك أو خدمتك </p>
                  
              </div>
              <div class="big-icon h1 text-custom">
                  <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                  </svg></span>
              </div>
          </div>
      </div>

        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
            <div class="card service-wrapper rounded border-0 shadow p-4">
                <div class="icon text-center text-custom h1 shadow rounded bg-white">
                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                      <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
                      <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
                    </svg></span>
                </div>
                <div class="content mt-4">
                    <h5 class="title">انشاء الهوية التجارية</h5>
                    <p class="text-muted mt-3 mb-0" style="    font-family: 'Tajawal', sans-serif;"> إنشاء الهوية التجارية والخاصة بك او بمشروعك     </p>
                    
                </div>
                <div class="big-icon h1 text-custom">
                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                      <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
                      <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
                    </svg></span>
                </div>
            </div>
        </div>
        
        
    
</div>

<div id="our_philosophy" anchor></div> </div>
 
  </div>

</section>
<br/><br/>
<section id="our_philosophy" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" >
  <div class="our_philosophy_1" style="
  padding: 23px;margin-top: 35px;
">
    <div class="our_philosophy-body">
   <div class="section_title"><h1 id="sec">فلسفتنا </h1></div>
   <br/> 
   <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;">من خلال الخبرة التي يتميز بها فريقنا و بعد وقت طويل من العمل في هذا المجال لاحظنا بأن العديد من العلامات التجارية مهتمة باستخدام جميع الطرق و الأساليب المتاحة للتسويق لمنتجاتها أو خدماتها لكن ما يجهلونه هو أن الأمر لم يعد يتعلق فقط بتشغيل الحملات الإعلانية أو إنشاء محتوى مثالي بل يتعلق بكيفية التوصل إلى الصيغة المثالية التي تشمل جميع العناصر المطلوبة للتسويق الصحيح و الفعال كذلك القدرة على التنبؤ المستقبل لضمان النتائج المرغوبة
          لذلك أنت بحاجة إلى وكالة تركز على التخطيط الفعال الذي يمكنك من استقطاب العملاء المناسبين لك و كذا إيجاد حلول لمختلف المشاكل التي يمكن أن تواجهك خلال تطوير تجارتك الإلكترونية عن طريق التفكير خارج الصندوق عند إنشاء 
          .إستراتيجية رقمية
          </p>

      </div>
      <div class="col-sm-4">
        <img src="img/3.png" class="img-fluid"  >

      </div>
    </div>
  </section>
    <section id="advice" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" >
      <div class="our_adv" style="
      padding: 23px;margin-top: 35px;
    ">
        <div class="our_adv-body">
    <div class="section_title"><h1 id="sec" style="text-align:center;">إليك كيف يمكننا ضمان نتائج المشاريع و  تطويرها</h1></div>
    <div class="section_title"><h1 style="color:#fa0402;text-align:center;text-shadow: #db574f 0 0 4px;"> من 0 دولار إلى 50 ألف دولار خلال شهر واحد</h1></div>
    <br>
    <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <img src="img/4.png" class="img-fluid">

      </div>
      <div class="col-sm-8">
 
        <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;"> يعمل فريق MEDIAWAN على وضع إستراتيجية شاملة للتسويق لمنتجك أو خدمتك تتوافق مع أهداف مشروعك و تضمن لك النتائج التي تطمح لها باستعمال وسائل و تقنيات متطورة جدا في مجال التسويق الإلكتروني
          </p>
          <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;"> <i class="bi bi-check2"></i> بناء علامة تجارية تميزك عن منافسيك 
          </p>
          <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;"> <i class="bi bi-check2"></i> 	إنشاء متجر إلكتروني مخصص لتسويق مشروعك و تحويل الزائرين إلى عملاء
          </p>
          <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;"> <i class="bi bi-check2"></i> 		إنشاء وإطلاق حمل  إعلانية مستهدفة على جميع المنصات الإعلاني 
          </p>
          <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;"> <i class="bi bi-check2"></i> 			مع الحرص على تحسين معدل التحويلات
          </p>
          <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-custom" style="background-color:#5555af;color:#fff;font-family: 'Changa', sans-serif;margin-right: 51px;
                margin-top: 5px;zoom:0.8;float:left;">إحجز مكالمتك الأن</button>
      </div></div>
    </div>
    </div>
  </div>
    </section>
    <section id="products" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" >
      <div class="our_product" style="
      padding: 23px;margin-top: 35px;
    ">
        <div class="our_products-body">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
               
                <div class="section_title"><h3 style=";text-align:center; color:#fff;">صور لبعض نتائجنا التسويقية الناجحة</h3></div>
             <br>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="https://thumbs.dreamstime.com/b/example-red-tag-example-red-square-price-tag-117502755.jpg">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>...</h5>
                        <p>...</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://st2.depositphotos.com/3765753/5349/v/450/depositphotos_53491489-stock-illustration-example-rubber-stamp-vector-over.jpg" alt="Second slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>...</h5>
                        <p>...</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://media.istockphoto.com/photos/objectives-word-on-paper-through-magnifying-lens-picture-id1320879074?b=1&k=20&m=1320879074&s=170667a&w=0&h=oiLBgFo89zDqwWQAEedqOeitin89ceJF3wIxj7yzh-A=" alt="Third slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>...</h5>
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
           
              </div>
              <div class="col-sm-6">
                <div class="section_title"><h1 style="color:#fff;text-align:center;">نتائج عملائنا تبرهن كل شيء</h1></div>
                <p style="margin-right: 10px;direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color: #fff; font-size: 22px;">يمكنك قراءة أرباح واحد من أهم المشاريع التي طورتها الوكالة 
                  استطاعت تحقيق أرقام مذهلة و نتائج فوق المتوقع
                  ماذا تنتظر؟ احجز مكالمتك الآن للعمل على استراتيجية لتطوير مشروعك
                  
                </p>
              </div>
             
              
            </div> 
            <br/> <br/>   <br/>
            <div class="section_title"><h1 style="color:#fff;text-align:center;"> لماذا عليك أن تدع فريق MEDIAWAN</h1></div>
            <div class="section_title"><h3 style="color:#fff;text-align:center;"> يعمل على ما هو بارع فيه لتحصل على النتائج التي لطالما بحثت عنها ؟</h3></div>
          </div> 
          </div> 
          <br/>
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                <img src="img/5.png" class="img-fluid" >
        
              </div>
              <div class="col-sm-8">
                   <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;">
                    من أهدافنا الأساسية:
                  </p>
                  <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;"> <i class="bi bi-check2"></i> 		نتائج أرباحك مضمونة
                  </p>
                  <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;"> <i class="bi bi-check2"></i> 		توفير مالك و وقتك
                  </p>
                  <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;"> <i class="bi bi-check2"></i> 		تقديم خدماتنا بأسعار مناسبة
                  </p>
                  <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;"> <i class="bi bi-check2"></i> 	وسيع مشروعك في وقت وجيز
                  </p>
                  <p style="direction: rtl;  text-align: initial; font-family: 'Tajawal', sans-serif; color:#fff; font-size: 22px;"> <i class="bi bi-check2"></i> تقديم خدمة عملاء ذات جودة عالية
                  </p>
        </div>
      </div>
     
    </div>
<center>
    <div id="sep_1" style="margin-top:25px;background: #2e2d59;width: 75%;border-radius: 11px;color: #fff;box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
      <div class="container">
        <div class="row" style="padding: 8px;">
          <div class="col-sm-8">
            <div class="section_title"><h4 style="direction: rtl;
              text-align: initial;color:#fff"> ابدء تسلق سلم نجاح مشروعك    </h4></div>

    
          </div>
          <div class="col-sm-4">
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-custom" style="background-color:#5555af;color:#fff;font-family: 'Changa', sans-serif
          ;zoom:0.8;">إحجز مكالمتك الأن</button>
    </div>
  </div>
 
</div>
        
    </div>
  </center>
          </section>
          <section id="questions" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" >
            <div class="question_s" style="
            padding: 23px;margin-top: 35px;
          ">
              <div class="questions-body">
                <div class="section_title"><h1 style="color:#fff;text-align:center;">أسئلة شائعة</h1></div>
<br/>
<center>
<section class="comment" >
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="card text-dark">
          <div class="card-body p-4">
            <div class="d-flex flex-start">
              <img class="rounded-circle shadow-1-strong me-3"
                src="img\ava1.jpg" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold mb-3">الاسم الكامل</h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0">
                  March 15, 2021
                    
                     
                    <span class="badge bg-primary">Pending</span>
                  </p>
                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                </div>
                <p class="mb-0">
                وهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكية
                </p>
              </div>
            </div>
          </div>

          <hr class="my-0" />

          <div class="card-body p-4">
            <div class="d-flex flex-start">
              <img class="rounded-circle shadow-1-strong me-3"
                src="img\ava2.jpg" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold mb-1">Lara Stewart</h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0">
                    March 15, 2021
                    <span class="badge bg-success">Approved</span>
                  </p>
                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                  <a href="#!" class="text-success"><i class="fas fa-redo-alt ms-2"></i></a>
                  <a href="#!" class="link-danger"><i class="fas fa-heart ms-2"></i></a>
                </div>
                <p class="mb-0">
                وهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكية
                </p>
              </div>
            </div>
          </div>

          <hr class="my-0" style="height: 1px;" />

          <div class="card-body p-4">
            <div class="d-flex flex-start">
              <img class="rounded-circle shadow-1-strong me-3"
                src="img\ava3.jpg" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold mb-1">Alexa Bennett</h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0">
                    March 24, 2021
                    <span class="badge bg-danger">Rejected</span>
                  </p>
                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                </div>
                <p class="mb-0">
                وهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكية
                </p>
              </div>
            </div>
          </div>

          <hr class="my-0" />

          <div class="card-body p-4">
            <div class="d-flex flex-start">
              <img class="rounded-circle shadow-1-strong me-3"
                src="img\ava4.jpg" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold mb-1">Betty Walker</h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0">
                    March 30, 2021
                    <span class="badge bg-primary">Pending</span>
                  </p>
                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                  <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                </div>
                <p class="mb-0">
                وهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكيةوهناك مثال ثالث لناخذ مثال على المنتجات الاستهلاكية
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<br/>
<br/>
<section id="clients" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" ></section>
<div class="section_title"><h1 style="color:#fff;text-align:center;">بعض عملائنا</h1></div>
  <div class="clients_s" style="
            padding: 23px;margin-top: 35px;
          ">
          <div class="card" style=" width: 75%; background: #2e2d59; color: #fff; font-family: 'Tajawal', sans-serif;margin:auto; ">
            <div class="card-body" style=" height: 163px; ">
              <div id="card-icon" style=" font-size: 150px; "><i class="bi bi-award-fill" style="
                position: absolute;
                right: 0;
                bottom: 0;
                opacity: 0.05;
            "></i></div>
            <div class="container">
              <div class="row">
                <div class="col-sm">
                  <img class="img-fluid" src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo3.png"/>
                </div>
                <div class="col-sm">
                  <img class="img-fluid" src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo2.png"/>
                </div>
                <div class="col-sm">
                  <img  class="img-fluid" src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo3.png"/>
                </div>
                <div class="col-sm">
                  <img class="img-fluid" src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo2.png"/>
                </div>
              </div>
            </div>
</div></div></div>
</section>
<section id="banner" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" ></section>

  <div class="banner_s" style="
            padding: 23px;margin-top: 35px;
          ">

<div class="card" style=" width: 75%; background: #2e2d59; color: #fff; font-family: 'Tajawal', sans-serif;margin:auto; ">
  <div class="card-body" style=" height: 163px; ">
    <div id="card-icon" style=" font-size: 150px; "><i class="bi bi-briefcase-fill" style="
      position: absolute;
      right: 0;
      bottom: 0;
      opacity: 0.05;
  "></i></div>
  <div class="container">
    <div class="row">
     
      <div class="col-sm-4">
        <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-custom" style="background-color:#5555af;color:#fff;font-family: 'Changa', sans-serif;margin-right: 51px;
                margin-top: 5px;zoom:0.8;animation:heartBeat;animation-duration: 0.9s; animation-iteration-count: 3;">إحجز مكالمتك الأن</button>
      </div>
      <div class="col-sm-8">
        <h2 style="float:right;color:#fff">  ? هل أنت جاهز لتكون ضمن أهم عملائنا</h2>
        <p style="float:right;color:#fff">احجز حصة مجانية مع أحد المختصين من فريقنا لتحديد الإستراتيحية المناسبة لمنتجك

        </p>
       </div>
    </div>
  </div>
</div></div>
          </div></div>
        </section>

        <section id="ft" style="animation: fadeInLeft;animation-duration: 2.5s;direction: rtl;text-align: initial;margin: 51px;direction: rtl;text-align: initial;margin: 51px;width: 97%;margin: auto;" ></section>

  <div class="ft_s" style="
            padding: 23px;margin-top: 35px;
          ">

<div class="card" style=" width: 75%; background: #2e2d59; color: #fff; font-family: 'Tajawal', sans-serif;margin:auto; ">
  <div class="card-body" style=" height: 163px; ">
    <div id="card-icon" style=" font-size: 150px; "><i class="bi bi-patch-question-fill" style="
      position: absolute;
      right: 0;
      bottom: 0;
      opacity: 0.05;
  "></i></div>
  <div class="container">
    <div class="row">
     
      <div class="col-sm-8">
      <p><i class="bi bi-geo-alt-fill"></i> AGADIR</p>
      <p><i class="bi bi-envelope"></i> contact@media.com</p>
      <p><i class="bi bi-telephone-fill"></i> +212 00 000 00 00</p>
      </div>
      <div class="col-sm-4">
        <h2 style="float:right;color:#fff">  هل لديك استفسار عام؟</h2>
        <p style="float:right;direction: rtl;text-align: initial;color:#fff">إذا كان لديك استفسار عام وترغب في التحدث إلى فريق الخبراء لدينا، يمكنك الاتصال بنا عبر البريد الإلكتروني

        </p>
       </div>
    </div>
  </div>
</div></div>
          </div></div>
        </section>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="margin-bottom: -7.5rem!important;background: #212140;">
      
          <p class="col-md-4 mb-0 " style="margin:auto;text-align: center;font-size: 9px;color:#fff;">© 2022 MEDIAWAN  MARKETING
            THIS SITE IS NOT A PART OF THE FACEBOOK WEBSITE OR FACEBOOK INC.
            ADDITIONALLY, THIS SITE IS NOT ENDORSED BY FACEBOOK IN ANY WAY.
            FACEBOOK IS A TRADEMARK OF FACEBOOK, INC.
            </p>
      
        
         
        </footer>
        <script>  
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const return_v = urlParams.get('r')
if (return_v=="1"){
  Swal.fire(
  'تم حجز الموعد بنجاح',
  '   ',
  'success'
)

}
if (return_v=="0"){
  Swal.fire(
  'المرجو التأكد من المعلومات',
  '',
  'error'
)

}
      </script> 
</body>
</html>
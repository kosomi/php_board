<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <div class="ttresponsive">
    <div class="container">

      <div class="row">
        <div class="ttcol-md-12 ttnt-col tthader"> 
          <div class="ttwidget">
            <a href="index.php"> Index </a> &nbsp;&nbsp;
            <a href="index.php?list=33"> List </a> &nbsp;&nbsp;
          </div>
        </div>
      </div>

      <?php
      
        if (isset($_GET['list'])&&$_GET['list']=='33') {
          $translayList = 'nonedisplay';
          $translayMain = 'ttcol-md-9';
        } else {
          $translayList = 'ttcol-md-3';
          $translayMain = 'ttcol-md-6';
        }

      ?>

      <div class="row">
        <div class="<?=$translayList?> ttnt-col ttlist">
          <div class="ttwidget">
            <?php include('menu.php') ?>
          </div>
        </div>
        <div class="<?=$translayMain?> ttnt-col ttmain">
          <div class="ttwidget">
            <?php include_once('view.php') ?>
          </div>
        </div>
        <div class="ttcol-md-3 ttnt-col">
          <div class="ttwidget ttside">
            Side 1 <br>
            <?php include('menu.php') ?>
          </div>
          <div class="ttwidget ttside">
            Side 2 <br>
            <?php include('menu.php') ?>
          </div>
          <div class="ttwidget ttside">
            Side 3 <br>
            <?php include('menu.php') ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="ttcol-md-12 ttnt-col"> 
          <div class="ttwidget ttfooter">
            Footer
          </div>
        </div>
      </div>

    </div>
  </div>

  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 2px;
      background: #aaa;
    }
    .ttresponsive {
      max-width: 1200px;
      background: #bbb;
      margin: 0px auto;
    }

    .ttnt-col {
      float: left;
      padding: 0px 2px;
      width: 100%;
    }
    .ttnt-col .ttwidget {
      background: #ccc;
      width: 100%;
      padding: 10px;
      margin-bottom: 4px;
    }
    .nonedisplay {
      display: none;
    }

    /* 데스크탑 브라우저 // 창 width가 1200px 보다 커지는 순간부터 적용 */
    @media all and (min-width: 1200px){
      .ttcol-md-3 {
        max-width: 300px;
      }
      .ttcol-md-6 {
        max-width: 600px;
      }
      .ttcol-md-9 {
        max-width: 900px;
      }
      .ttcol-md-12 {
        max-width: 1200px;
      }
    }
    /* 모바일 브라우저 // 창 width가 1200px 보다 작아지는 순간부터 적용 */
    @media all and (max-width: 1200px){
      .ttresponsive .ttlist {
        display: none;
      }
    }
  </style>
  
</body>
</html>
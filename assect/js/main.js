$(document).ready(function () {
  // quick mwnu
  var quick_menu = false;
  $(".quick_btn").click(function () {
    if (quick_menu == false) {
      $(".mobile_submit").css("transform", "translateY(0)");
      $(".mobile_submit").css("opacity", "1");
      $(".mobile_menu").css("transform", "translateY(-650px)");
      $(".mobile_menu").css("opacity", "0");
      quick_menu = true;
    } else {
      $(".mobile_submit").css("transform", "translateY(-650px)");
      $(".mobile_submit").css("opacity", "0");
      quick_menu = false;
    }
  });

  $(".quickBookone").click(function () {
    $(".mobile_submit").css("transform", "translateY(0)");
    $(".mobile_submit").css("opacity", "1");
    $(".quickBooktow").css("display", "block");
    $(".quickBookone").css("display", "none");
    $(".mobile_menu").css("transform", "translateY(-650px)");
    $(".mobile_menu").css("opacity", "0");
  });
  $(".quickBooktow").click(function () {
    $(".mobile_submit").css("transform", "translateY(-650px)");
    $(".mobile_submit").css("opacity", "0");
    $(".quickBookone").css("display", "block");
    $(".quickBooktow").css("display", "none");
  });

  // nav menu
  var menu = false;
  $(".menu_btn").click(function () {
    if (menu == false) {
      $(".mobile_menu").css("transform", "translateY(0)");
      $(".mobile_menu").css("opacity", "1");
      menu = true;
    } else {
      $(".mobile_menu").css("transform", "translateY(-650px)");
      $(".mobile_menu").css("opacity", "0");
      menu = false;
    }
    $(".mobile_submit").css("transform", "translateY(-650px)");
    $(".mobile_submit").css("opacity", "0");
    $(".quickBookone").css("display", "block");
    $(".quickBooktow").css("display", "none");
  });

  $(".menu_btn_phone").click(function () {
    if (menu == false) {
      $(".mobile_menu").css("transform", "translateY(0)");
      $(".mobile_menu").css("opacity", "1");
      menu = true;
    } else {
      $(".mobile_menu").css("transform", "translateY(-650px)");
      $(".mobile_menu").css("opacity", "0");
      menu = false;
    }
  });

  $(".mobile_menu p a").click(function () {
    $(".mobile_menu").css("transform", "translateY(-650px)");
    $(".mobile_menu").css("opacity", "0");
    menu = false;
  });
});

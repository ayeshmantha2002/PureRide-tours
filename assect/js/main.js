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

  var fleet = true;
  $(".fleet_link").click(function () {
    if (fleet == true) {
      $(".fleet_view").css("display", "block");
      $(".rate_view").css("display", "none");
      fleet = false;
    } else {
      $(".fleet_view").css("display", "none");
      $(".rate_view").css("display", "none");
      fleet = true;
    }
  });

  var rates = true;
  $(".rates_link").click(function () {
    if (rates == true) {
      $(".rate_view").css("display", "flex");
      $(".fleet_view").css("display", "none");
      rates = false;
    } else {
      $(".rate_view").css("display", "none");
      $(".fleet_view").css("display", "none");
      rates = true;
    }
  });

  $("#reply").click(function () {
    $(".reply_section").css("display", "flex");
  });

  $(".xxx").click(function () {
    $(".reply_section").css("display", "none");
    $(".whatsapp").css("display", "none");
    $(".booking").css("display", "none");
  });

  $(".whatsapp_button").click(function () {
    $(".whatsapp").css("display", "flex");
  });
  $("#whatsapp_dd").click(function () {
    $(".whatsapp").css("display", "flex");
  });

  var show_pw = true;
  $("#show_pw").click(function () {
    if (show_pw == true) {
      $(".pw").attr("type", "text");
      show_pw = false;
    } else {
      $(".pw").attr("type", "password");
      show_pw = true;
    }
  });
});

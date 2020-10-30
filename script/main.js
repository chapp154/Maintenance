
$("#id-btn-add").click(function (e) { 
    e.preventDefault();
    $(".tasks__table--inputs-tr").fadeIn(500);        
});

$("#id-submit").click(function (e) { 
    e.preventDefault();
    
    $.ajax({
        type: "POST",
        url: "../php/add.php",
        data: $("#id-form-add").serialize(),
        success: function (html) {
            console.log("TASK ADDED");
            document.getElementById("ajax").innerHTML = html;
        }
    });

    setTimeout(function () {
        window.location.href='../index.php';
    }, 500);
});

// URGENT
$(".urgent__input").click(function () { 
    var id_full = $(this).attr("id");
    var id_arr = Array.from(id_full);
    var id_length = id_arr.length;

    if (id_length <= 4) {
        var id = id_arr[3];
    }
    else if (id_length <= 5) {
        var id = id_arr[3] + id_arr[4];
    }
    else if (id_length <= 6) {
        var id = id_arr[3] + id_arr[4] + id_arr[5];
    }
    else if (id_length <= 7) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6];
    }
    else if (id_length <= 8) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6] + id_arr[7];
    }
    else {
        console.log("ID is too long!");
    }

    var urgent_check = document.getElementById(id_full);
    var done_check = document.getElementById("id_" + id);

    if (urgent_check.checked) {
        if (done_check.checked) {
            $("#tr-" + id).css({"color":"#00a214", "font-weight":"400"});

        }
        else {
            $("#tr-" + id).css({"color":"#f33d3d", "font-weight":"700"});
        }

        $.ajax({
            type: "POST",
            url: "../php/checked.php",
            data: "id=" + id + "&urgent=1",
            success: function (html) {
            }
        });
    }

    else {
        if (done_check.checked) {
            $("#tr-" + id).css({"color":"#00a214", "font-weight":"400"});
        }
        else {
            $("#tr-" + id).css({"color" : "inherit", "font-weight" : "400"});
        }

        $.ajax({
            type: "POST",
            url: "../php/checked.php",
            data: "id=" + id + "&urgent=2",
            success: function (html) {
            }
        });    
    }
});

// DONE
$(".done__input").click(function () { 
    var id_full = $(this).attr("id");
    var id_arr = Array.from(id_full);
    var id_length = id_arr.length;

    if (id_length <= 4) {
        var id = id_arr[3];
    }
    else if (id_length <= 5) {
        var id = id_arr[3] + id_arr[4];
    }
    else if (id_length <= 6) {
        var id = id_arr[3] + id_arr[4] + id_arr[5];
    }
    else if (id_length <= 7) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6];
    }
    else if (id_length <= 8) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6] + id_arr[7];
    }
    else {
        console.log("ID is too long!");
    }

    var urgent_check = document.getElementById("id-" + id);
    var done_check = document.getElementById(id_full);

    if (done_check.checked || done_check.checked && urgent_check.checked) {
        $("#tr-" + id).css({"color" : "#00a214", "font-weight" : "400"});
        $.ajax({
            type: "POST",
            url: "../php/checked.php",
            data: "id=" + id + "&done=1",
            success: function (html) {
            }
        });
    }

    else {
        if (urgent_check.checked) {
            $("#tr-" + id).css({"color":"#f33d3d", "font-weight":"700"});
        }
        else {
            $("#tr-" + id).css("color" , "inherit");
        }

        $.ajax({
            type: "POST",
            url: "../php/checked.php",
            data: "id=" + id + "&done=2",
            success: function (html) {
            }
        });    
    }
});

// DELETE
$(".btn-options-del").click(function () { 
    var full_id = $(this).attr("id");
    var id_arr = Array.from(full_id);
    var id_length = id_arr.length;

    if (id_length <= 4) {
        var id = id_arr[3];
    }
    else if (id_length <= 5) {
        var id = id_arr[3] + id_arr[4];
    }
    else if (id_length <= 6) {
        var id = id_arr[3] + id_arr[4] + id_arr[5];
    }
    else if (id_length <= 7) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6];
    }
    else if (id_length <= 8) {
        var id = id_arr[3] + id_arr[4] + id_arr[5] + id_arr[6] + id_arr[7];
    }
    else {
        console.log("ID is too long!");
    }

    $.ajax({
        type: "POST",
        url: "../php/del.php",
        data: "del=1" + "&id=" + id,
        success: function (response) {
            
        }
    });

    $("#tr-" + id).fadeOut(500);
});

$(".btn__options-main").click(function (e) { 
    e.preventDefault();
    
});

// SCROLL
// The debounce function receives our function as a parameter
const debounce = (fn) => {

    // This holds the requestAnimationFrame reference, so we can cancel it if we wish
    let frame;
  
    // The debounce function returns a new function that can receive a variable number of arguments
    return (...params) => {
      
      // If the frame variable has been defined, clear it now, and queue for next frame
      if (frame) { 
        cancelAnimationFrame(frame);
      }
  
      // Queue our function call for the next frame
      frame = requestAnimationFrame(() => {
        
        // Call our function and pass any params we received
        fn(...params);
      });
  
    } 
  };
  
  
  // Reads out the scroll position and stores it in the data attribute
  // so we can use it in our stylesheets
  const storeScroll = () => {
    document.documentElement.dataset.scroll = window.scrollY;
  }
  
  // Listen for new scroll events, here we debounce our `storeScroll` function
  document.addEventListener('scroll', debounce(storeScroll), { passive: true });
  
  // Update scroll position for first time
  storeScroll();
  document.querySelector('.sweet-10').onclick = function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: 'btn-primary',
      confirmButtonText: 'Primary!'
    });
  };

  document.querySelector('.sweet-11').onclick = function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: 'btn-info',
      confirmButtonText: 'Info!'
    });
  };

  document.querySelector('.sweet-12').onclick = function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "success",
      showCancelButton: true,
      confirmButtonClass: 'btn-success',
      confirmButtonText: 'Success!'
    });
  };

  document.querySelector('.sweet-13').onclick = function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: 'btn-warning',
      confirmButtonText: 'Warning!'
    });
  };

  document.querySelector('.sweet-14').onclick = function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "error",
      showCancelButton: true,
      confirmButtonClass: 'btn-danger',
      confirmButtonText: 'Danger!'
    });
  };


/*cara penggunaan:
<button class="btn btn-lg btn-primary sweet-10" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Primary']);">Primary</button>
<button class="btn btn-lg btn-info sweet-11" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Info']);">Info</button>
<button class="btn btn-lg btn-success sweet-12" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Success']);">Success</button>
<button class="btn btn-lg btn-warning sweet-13" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Warning']);">Warning</button>
<button class="btn btn-lg btn-danger sweet-14" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Danger']);">Danger</button>
*/
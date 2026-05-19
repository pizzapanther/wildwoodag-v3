{
  title: Welcome to Our Community
  template: home.html
}

<div id="calendar-js" style="clear: both;"></div>
<script src='/cal.js'></script>
<script>
  var home_cal = load_calendar('list', true);

  function load_events () {
    var home_events = home_cal.getEvents().slice(0, 5);
    console.log(home_events);

    if (home_events.length) {

    } else {
      setTimeout(() => {
        load_events();
      }, 500);
    }
  }

  setTimeout(() => {
    load_events();
  }, 500);

</script>

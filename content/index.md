{
  title: Welcome to Our Community
  template: home.html
}

<div id="calendar-js" style="clear: both; display: none;"></div>
<script src='/cal.js'></script>
<template id="event-template">
  <li class="pt-3 pb-3">
    <div class="d-flex gap-3">
        <div class="event-date rounded-1 text-center">
            <h4 class="date mb-0 lh-1">18</h4>
            <span class="fs-8 month">Jul</span>
            <span class="fs-8 year">2024</span>
        </div>
        <div class="content">
            <p class="fs-6 mb-1 title"></p>
            <span class="event-meta fs-8">
                <i class="fa fa-clock me-1"></i>
                <span class="time"></span>
            </span>
        </div>
    </div>
  </li>
</template>
<script>
  var home_cal = load_calendar('list', true);
  const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  function insert_event(e) {
    // console.log(e);
    const template = document.querySelector("#event-template");
    const clone = document.importNode(template.content, true);

    let ptitle = clone.querySelector("p.title");
    ptitle.textContent = e.title;

    let h4 = clone.querySelector("h4.date");
    h4.textContent = e.start.getDate();

    let m = clone.querySelector("span.month");
    m.textContent = MONTHS[e.start.getMonth()];

    let y = clone.querySelector("span.year");
    y.textContent = e.start.getFullYear();

    let t = clone.querySelector("span.time");
    let tstr = e.start.toLocaleTimeString();
    tstr = tstr.replace(":00 ", " ");
    t.textContent = tstr;

    const ul = document.querySelector("#event-list");
    ul.appendChild(clone);
  }

  function sort_events (a, b) {
    if (a.start.getTime() < b.start.getTime()) {
      return -1;
    } else if (a.start.getTime() > b.start.getTime()) {
      return 1;
    }

    return 0;
  }

  function render_list() {
    let now = Date.now();
    let home_events = home_cal.getEvents();
    let cnt = 0;
    home_events.sort(sort_events);
    home_events.forEach((e) => {
      if (e.start.getTime() > now && cnt < 7) {
        insert_event(e);
        cnt += 1;
      }
    });
  }

  function load_events () {
    const loaded = document.querySelector("#calendar-js table");

    if (loaded) {
      setTimeout(() => {
        render_list();
      }, 40);
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

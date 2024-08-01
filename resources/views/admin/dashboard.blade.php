@extends('../app')
@section('body')
@include('admin/menu')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");
    .calendar {
      margin: auto;
      width: 98%;
      max-width: 100%;
      padding: 1rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .calendar header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .calendar nav {
      display: flex;
      align-items: center;
    }
    .calendar ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      text-align: center;
    }
    .calendar ul li {
      width: calc(100% / 7);
      margin-top: 25px;
      position: relative;
      z-index: 2;
    }
    #prev,
    #next {
      width: 40px;
      height: 40px;
      position: relative;
      border: none;
      background: transparent;
      cursor: pointer;
    }
    #prev::before,
    #next::before {
      content: "";
      width: 50%;
      height: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      border-style: solid;
      border-width: 0.25em 0.25em 0 0;
      border-color: #ccc;
    }
    #next::before {
      transform: translate(-50%, -50%) rotate(45deg);
    }
    #prev::before {
      transform: translate(-50%, -50%) rotate(-135deg);
    }
    #prev:hover::before,
    #next:hover::before {
      border-color: #000;
    }
    .days {
      font-weight: 600;
    }
    .dates li.today {
      color: #fff;
    }
    .dates li.today::before {
      content: "";
      width: 4rem;
      height: 4rem;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #000;
      border-radius: 50%;
      z-index: -1;
    }
    .dates li.inactive {
      color: #ccc;
    }
    </style>
    
            <div class="container-fluid">
                {{-- <h1 class="mb-4">Selamat Datang Admin</h1> --}}
                <div class="calendar pb-2">
                    <header>
                      <h2 class="h1"></h2>
                      <nav>
                        <button id="prev"></button>
                        <button id="next"></button>
                      </nav>
                    </header>
                    <section style="font-size: 40px">
                      <ul class="days">
                        <li>Min</li>
                        <li>Sen</li>
                        <li>Sel</li>
                        <li>Rab</li>
                        <li>Kam</li>
                        <li>Jum</li>
                        <li>Sab</li>
                      </ul>
                      <ul class="dates"></ul>
                    </section>
                  </div>
    
            
            </div>
    
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Dinas Kominfo Barito Kuala 2024</span>
                </div>
            </div>
        </footer>
    </div>
    </body>
    <script>
        const header = document.querySelector(".calendar h2");
    const dates = document.querySelector(".dates");
    const navs = document.querySelectorAll("#prev, #next");
    
    const months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    
    let date = new Date();
    let month = date.getMonth();
    let year = date.getFullYear();
    
    function renderCalendar() {
      const start = new Date(year, month, 1).getDay();
      const endDate = new Date(year, month + 1, 0).getDate();
      const end = new Date(year, month, endDate).getDay();
      const endDatePrev = new Date(year, month, 0).getDate();
    
      let datesHtml = "";
    
      for (let i = start; i > 0; i--) {
        datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
      }
    
      for (let i = 1; i <= endDate; i++) {
        let className =
          i === date.getDate() &&
          month === new Date().getMonth() &&
          year === new Date().getFullYear()
            ? ' class="today"'
            : "";
        datesHtml += `<li${className}>${i}</li>`;
      }
    
      for (let i = end; i < 6; i++) {
        datesHtml += `<li class="inactive">${i - end + 1}</li>`;
      }
    
      dates.innerHTML = datesHtml;
      header.textContent = `${months[month]} ${year}`;
    }
    
    navs.forEach((nav) => {
      nav.addEventListener("click", (e) => {
        const btnId = e.target.id;
    
        if (btnId === "prev" && month === 0) {
          year--;
          month = 11;
        } else if (btnId === "next" && month === 11) {
          year++;
          month = 0;
        } else {
          month = btnId === "next" ? month + 1 : month - 1;
        }
    
        date = new Date(year, month, new Date().getDate());
        year = date.getFullYear();
        month = date.getMonth();
    
        renderCalendar();
      });
    });
    
    renderCalendar();
    
    </script>
@endsection

@section ('active')
<script>
    $(document).ready(function () {
        $("#beranda").addClass("active");
    });

</script>
@endsection

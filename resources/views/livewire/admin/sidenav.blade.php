    <div class="sidebar-menu">
        {{-- <a href="javascript:void(0)" class="closebtn" onclick="checkToggle()">&times;</a> --}}
        <div class="sidebar-link-item ">
            <h3 class="hideText icon-span menu-active">User: {{Auth::user()->name}}</h3>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewCalendar')}} ">
            <i class="fas fa-2x fa-calendar-check pr-4"></i>
            <a href="/calendar" class="hideText icon-span menu-active">Calendar</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewBookings') }} {{ checkRoute('addBooking')}}">
            <i class="fas fa-2x fa-clock pr-4"></i>
            <a href="/bookings/view" class="hideText icon-span">Bookings</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewCustomers')}} ">
            <i class="fas fa-2x fa-user-friends pr-4"></i>
            <a href="/customers" class="hideText icon-span">Customers</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewStaff')}} ">
            <i class="fas fa-2x fa-id-badge pr-4"></i>
            <a href="/staff" class="hideText icon-span">Staff</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewOrders')}} ">
            <i class="fas fa-2x fa-store pr-4"></i>
            <a href="/orders" class=" icon-span">Orders</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewProducts')}} ">
            <i class="fab fa-2x fa-product-hunt pr-4"></i>
            <a href="/products" class=" icon-span">Products</a>
        </div>

        
        <div class="sidebar-link-item {{checkRoute('viewReceipts')}} ">
            <i class="fas fa-2x fa-file-alt pr-4"></i>
            <a href="/receipts" class="hideText icon-span">Receipts</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewServices')}}">
            <i class="fas fa-2x fa-shopping-cart pr-4"></i>
            <a href="/services" class="hideText icon-span">Services</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewTemplates')}} ">
            <i class="fas fa-2x fa-paper-plane pr-4"></i>
            <a href="/templates" class="hideText icon-span">SMS templates</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewStatistics')}} ">
            <i class="fas fa-2x fa-chart-bar pr-4"></i>
            <a href="/statistics" class="hideText icon-span">Statistics</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewSetting')}} ">
            <i class="fas fa-2x fa-toolbox pr-4"></i>
            <a href="/settings" class="hideText icon-span">Settings</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewMessages')}} ">
            <i class="fas fa-2x fa-envelope-open-text pr-4"></i>
            <a href="/messages" class=" icon-span">Messages</a>
        </div>

        <div class="sidebar-link-item {{checkRoute('viewAccount')}}">
            <i class="fas fa-2x fa-user-circle pr-4"></i>
            <a href="/account" class=" icon-span">My account</a>
        </div>

        <div class="sidebar__logout">
            <i class="fa fa-power-off"></i>
            <a href="{{route('logout')}}">Log out</a>
        </div>

    </div>

    <script>

            var toggle = false;

            function checkToggle()
            {


                if(!toggle) {
                    openNav();
                } else {
                    closeNav();
                }
            }

    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
        function openNav() {
            toggle = true;

            document.getElementById("mySidenav").style.width = "15vw";
            document.getElementById("main").style.marginRight = "15vw";

            var elements = document.getElementsByClassName('icon-span');
            var i;
                for (i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('hideText');
                }
        }
        
        /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
        function closeNav() {
            toggle = false;

            document.getElementById("mySidenav").style.width = "5vw";
            document.getElementById("main").style.marginRight = "0";

            var elements = document.getElementsByClassName('icon-span');
            var i;
                for (i = 0; i < elements.length; i++) {
                    elements[i].classList.add('hideText');
                }
        }
    </script>
<div>

    <div class="container">
        <div class="row my-4">
            <div class="col-6">
                @livewire('stats.card', ['data' => $customersCount, 'title' => 'Total Customers'], key($customersCount))
            </div>

            <div class="col-6">
                @livewire('stats.card', ['data' => $upcomingBookings, 'title' => 'Upcoming Bookings'], key($upcomingBookings))
            </div>
        </div>
        
        <div class="row my-4">
            <div class="col-6">
                @livewire('stats.card', ['data' => $profit, 'title' => 'Total Profit'], key($profit))
            </div>

            <div class="col-6">
                @livewire('stats.card', ['data' => $cancelledBookings, 'title' => 'Cancelled Bookings'], key($cancelledBookings))
            </div>
        </div>

    </div>
</div>

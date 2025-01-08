<div class="card my-4 shadow-sm rounded">
    <div id="cardNav">
        <div class="card-body">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <a href="{{ route('user.dashboard') }}"
                        class="text-decoration-none text-{{ request()->routeIs('user.dashboard') ? 'info' : 'dark' }}">Dashboard</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('payment-list.index') }}"
                        class="text-decoration-none text-{{ request()->routeIs('payment-list.index') ? 'info' : 'dark' }}">Payment
                        List</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('rent-list.index') }}"
                        class="text-decoration-none text-{{ request()->routeIs('rent-list.index') ? 'info' : 'dark' }}">Rent
                        List</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('profile') }}"
                        class="text-decoration-none text-{{ request()->routeIs('profile') ? 'info' : 'dark' }}">Profile</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('withdraw.index') }}"
                        class="text-decoration-none text-{{ request()->routeIs('withdraw.index') ? 'info' : 'dark' }}">Withdraw
                        Balance</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('ticket.index') }}"
                        class="text-decoration-none text-{{ request()->routeIs('ticket.index') ? 'info' : 'dark' }}">Tickets</a>
                </li>
            </ul>
        </div>
    </div>
</div>

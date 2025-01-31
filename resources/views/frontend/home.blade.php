@extends('frontend.layouts.master',['page_slug'=>'home'])
@section('title', 'Export Apollo - Verified Leads, Low Prices')
@section('content')
    <!-- Order Form Section (Left) -->
    <div class="order-section">
        <h2>{{__('Order Your Leads')}}</h2>
        <form action="{{route('f.order')}}" method="post">
            @csrf
            <label for="name">{{__('Your Name:')}}</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            @include('alerts.feedback', ['field' => 'name'])

            <label for="phone">{{__('Your Phone Number:')}}</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            @include('alerts.feedback', ['field' => 'phone'])

            <label for="amount">{{__('Select Lead Amount:')}}</label>
            <select id="amount" name="lead" required onchange="updateTotal()">
                <option value="10k">10k - $30</option>
                <option value="20k">20k - $60</option>
                <option value="50k">50k - $150</option>
                <option value="100k">100k - $280</option>
                <option value="1m">1M - $2500</option>
            </select>
            @include('alerts.feedback', ['field' => 'lead'])

            <label for="apollo-url">{{__('Apollo Search URL:')}}</label>
            <input type="url" id="apollo-url" name="apollo_url" placeholder="Paste your Apollo search URL here" required>
            @include('alerts.feedback', ['field' => 'apollo_url'])


            <label for="extra-links">{{__('Additional Links (Extra $5 per link):')}}</label>
            <input type="number" id="extra-links" name="extra_links" placeholder="Enter number of additional links" min="0" oninput="updateTotal()">
            @include('alerts.feedback', ['field' => 'extra_links'])

            <div class="total-box" id="total-box">
                Total: $0
            </div>

            <button type="submit" >Order Now</button>
        </form>
    </div>

    <!-- Instructions and Video Section (Right) -->
    <div style="flex: 1; display: flex; flex-direction: column; gap: 30px;">
        <!-- Instructions Section -->
        <div class="instructions">
            <h2>Instructions:</h2>
            <ul>
                <li>✅ Make sure to tick the "Verified" filter under "Email Status" in Apollo</li>
                <li>✅ Create your Apollo filters and copy the search URL</li>
                <li>✅ Paste the search URL in the order form</li>
                <li>✅ Your CSV file will be sent to you in hours</li>
                <li>✅ Need bulk data? Email hello@exportapollo.in</li>
            </ul>
        </div>

        <!-- Video Section -->
        <div class="video-section">
            <h2>How to Order</h2>
            <iframe src="https://www.youtube.com/embed/avW65iWgY5I?start=33" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
@endsection
@push('js')
<script>
    function updateTotal() {
        const amount = document.getElementById('amount').value;
        const extraLinks = document.getElementById('extra-links').value || 0;
        const totalCost = calculateTotalCost(amount, extraLinks);
        document.getElementById('total-box').textContent = `Total: $${totalCost}`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateTotal();
    })

    function calculateTotalCost(amount, extraLinks) {
        let baseCost = 0;
        switch (amount) {
            case "10k": baseCost = 30; break;
            case "20k": baseCost = 60; break;
            case "50k": baseCost = 150; break;
            case "100k": baseCost = 280; break;
            case "1m": baseCost = 2500; break;
        }
        return baseCost + (extraLinks * 5);
    }
</script>
@endpush

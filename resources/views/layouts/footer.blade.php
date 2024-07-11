<footer><div class="footer-content">
    <p>&copy; 2024 FilmiDuniya. All rights reserved.</p>
    <ul class="footer-links">
        <li><a href="{{ url('policy') }}">Privacy Policy</a></li>
        <!-- <li><a routerLink="/term" routerLinkActive="active">Terms of Service</a></li> -->
        <li><a href="{{ url('contact') }}">Contact Us</a></li>
        <li><p class="text-info">Last Update: {{ \Carbon\Carbon::yesterday()->format('Y-M-d') }}</p>
        </li>
    </ul>
  </div>
  <div class="text-right"><p class="text-end text-danger" >* This Site is build for only educational Purpose</p></div>
  </footer>

<!-- Bootstrap JavaScript Libraries -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>
</body>
</html>

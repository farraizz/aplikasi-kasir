@if(Auth::user()->role == 'kasir')
<script>window.location ="/kasir"</script>
@endif

@if(Auth::user()->role == 'kasir')
<script>window.location ="/kasir/meja"</script>
@endif

@if(Auth::user()->role == 'admin')
<script>window.location ="/admin"</script>
@endif

@if(Auth::user()->role == 'manajer')
<script>window.location ="/manajer"</script>
@endif

{{-- @if(Auth::user()->role == 'manajer')
<script>window.location ="/products"</script>
@endif --}}
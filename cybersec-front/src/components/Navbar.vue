

<template>
  <div id="app">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/"> Home </a>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/models">Models <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/ingredients"> Ingredients</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/processes"> Process </a>
				</li>
			</ul>
		</div>
	</nav>
  </div>
</template>


<script>
export default {
  name: "Navbar"
};
</script>
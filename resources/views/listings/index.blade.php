<x-app-layout>


  @include('components.hero')


  <div class="pt-10"></div>

  @include('listings.index-search')

  <section>
    <div class="py-16">
      <div class="mx-auto px-6 max-w-6xl text-gray-500">
        <div id="card-list-container" class="mt-12 grid grid-cols-1">

          @include('listings.card-list', [
              'listings' => $listings,
          ])
        </div>

        <div id="load-more" class="text-center mt-6"></div>


      </div>
    </div>
  </section>
</x-app-layout>

<script>
  const pageInfo = {
    perPage: {{ $listings->perPage() }},
    total: {{ $listings->total() }},
    currentPage: {{ $listings->currentPage() }},
    lastPage: {{ $listings->lastPage() }},
  };

  let currentPage = pageInfo.currentPage;
  let nextPage = currentPage;


  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        loadMoreData();
      }
    })
  }, {
    thershold: 0.3
  })
  const loadMore = document.querySelector("#load-more");
  observer.observe(loadMore);


  function loadMoreData() {
    if (nextPage == pageInfo.lastPage) {
      observer.unobserve(loadMore)
      loadMore.classList.add('hidden');
      return;
    }

    nextPage += 1;
    const url = '/listings/lazyload?page=' + nextPage;

    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(html => {
        document.querySelector('#card-list-container').innerHTML += html;
        currentPage = nextPage; // Update currentPage
        initFlowbite();

      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
  }






</script>

<div class="relative bg-gradient-to-r from-purple-600 to-blue-600 h-screen text-white overflow-hidden">
  <div class="absolute inset-0">
    <img src="{{ asset('images/hero-bg.jpg') }}" alt="Background Image" class="object-cover object-center w-full h-50" />
    <div class="absolute inset-0 bg-black opacity-50"></div>
  </div>

  <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
    <h1 id="typewriter" class="text-5xl font-bold leading-tight mb-4">

    </h1>
    <span class="absolute top-0 right-0 bottom-0 left-auto mr-1 text-white text-2xl animate-blink">|</span>
    <a href="{{ route('listings.create') }}"
      class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">立即新增職缺</a>
    <p class="mt-2 text-lg text-gray-300 mb-8">
      *此網站僅為展示性質,非正式上線網站. <br>聯絡信箱:twkhjl@gmail.com</p>

  </div>
</div>

<style>
  #typewriter::after {
    content: "|";
    font-size: 120%;
    line-height: 20px;
    animation: blink .75s step-end infinite;
  }

  @keyframes blink {

    from,
    to {
      color: transparent
    }

    50% {
      color: rgba(245, 245, 245)
    }
  }
</style>
<script>
  const words = [
    "歡迎您來到本站!",
    "您可在這裡找尋想要的職缺...",
    "或是註冊以張貼職缺",
    "若您有任何問題或任何建議",
    "都歡迎透過下方的email與我聯絡",
    "十分感謝您!",
  ];

  let i = 0;
  let j = 0;
  let currentWord = "";
  let isDeleting = false;

  function type() {
    currentWord = words[i];
    if (isDeleting) {
      document.getElementById("typewriter").textContent = currentWord.substring(0, j - 1);
      j--;
      if (j == 0) {
        isDeleting = false;
        i++;
        if (i == words.length) {
          i = 0;
        }
      }
    } else {
      document.getElementById("typewriter").textContent = currentWord.substring(0, j + 1);
      j++;
      if (j == currentWord.length) {
        setTimeout(function() {
          isDeleting = true;
        }, 1000);
      }
    }
    setTimeout(type, 100);
  }

  type();
</script>

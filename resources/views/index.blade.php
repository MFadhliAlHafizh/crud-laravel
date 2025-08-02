<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Box Icons --}}
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- TailwindCSS --}}
    @vite('resources/css/app.css')

    <title>Library System</title>
</head>

<body class="font-['Poppins'] bg-gray-100">
    <div class="p-5">
        <div class="bg-cyan-800 flex justify-between items-center py-4 px-2.5 sm:px-9">
            <h1 class="text-lg sm:text-xl text-white font-semibold tracking-[2px]">Library</h1>
            <div class="flex gap-1 sm:gap-4">
                <form action="{{ route('buku.deleteAll') }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh buku?')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-[#e5383b] py-1 px-2 flex gap-1 sm:gap-2 items-center rounded-md cursor-pointer text-[12px] sm:text-sm sm:py-2 sm:px-3">
                        <i class='bx bx-minus bg-white rounded-full text-[#e5383b]'></i>
                        <span class="text-white">Delete All</span>
                    </button>
                </form>
                <button id="addBookButton"
                    class="bg-[#2dc653] py-1 px-2 flex gap-1 sm:gap-2 items-center rounded-md cursor-pointer text-[12px] sm:text-sm sm:py-2 sm:px-3">
                    <i class='bx bx-plus bg-white rounded-full text-[#2dc653]'></i>
                    <span class="text-white">Add Book</span>
                </button>
            </div>
        </div>

        <div class="mb-10">
            <div class="overflow-auto mb-4 rounded shadow-[0px_0px_6px_2px_rgba(0,_0,_0,_0.1)]">
                <table class="w-full">
                    <thead class="bg-gray-300 border-b-2 border-gray-500">
                        <tr>
                            <th class="p-4 text-start text-sm font-semibold tracking-wide whitespace-nowrap">No</th>
                            <th class="p-4 text-start text-sm font-semibold tracking-wide whitespace-nowrap">Judul Buku
                            </th>
                            <th class="p-4 text-start text-sm font-semibold tracking-wide whitespace-nowrap">Pengarang
                            </th>
                            <th class="p-4 text-start text-sm font-semibold tracking-wide whitespace-nowrap">Tahun
                                Terbit
                            </th>
                            <th class="p-4 text-start text-sm font-semibold tracking-wide whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                            <tr class="border-b-2 border-gray-200">
                                <td class="p-4 text-sm whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="p-4 text-sm whitespace-nowrap">{{ $item->judul }}</td>
                                <td class="p-4 text-sm whitespace-nowrap">{{ $item->pengarang }}</td>
                                <td class="p-4 text-sm whitespace-nowrap">{{ $item->tahun_terbit }}</td>
                                <td class="p-4 text-sm whitespace-nowrap flex gap-3">
                                    <button class="text-lg text-amber-500">
                                        <a href="{{ route('buku.edit', ['id' => $item->id]) }}">
                                            <i class='bx bxs-pencil'></i>
                                        </a>
                                    </button>

                                    <form action="{{ route('buku.delete', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku {{ $item->judul }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-lg text-red-600 cursor-pointer">
                                            <i class='bx bxs-trash-alt'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $buku->links() }}
        </div>

        @if (session('success'))
            <div class="flex items-center justify-between mb-5 p-4 text-sm text-green-800 bg-green-100 rounded-lg border border-green-300"
                role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-800 hover:text-green-900 focus:outline-none cursor-pointer"
                    onclick="this.parentElement.remove()" aria-label="Close">
                    ✕
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-5 text-sm text-red-800 bg-red-100 border border-red-300 rounded-lg" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="addBookForm"
            class="mt-5 bg-gray-50 p-6 rounded shadow-[0px_0px_6px_2px_rgba(0,_0,_0,_0.1)] w-full {{ isset($bukuDetail) ? '' : 'hidden' }}">
            <h2 class="text-xl font-semibold mb-4">{{ isset($bukuDetail) ? 'Edit Buku' : 'Tambah Buku' }}</h2>
            <form
                action="{{ isset($bukuDetail) ? route('buku.update', ['id' => $bukuDetail->id]) : route('buku.store') }}"
                method="post">

                @csrf

                @if (isset($bukuDetail))
                    @method('PUT')
                @endif

                <div class="mb-4 text-sm">
                    <label for="judul" class="block mb-1 font-medium text-gray-700">Judul Buku</label>
                    <input type="text" name="judul" id="judul" required
                        value="{{ old('judul', $bukuDetail->judul ?? '') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
                </div>
                <div class="mb-4 text-sm">
                    <label for="pengarang" class="block mb-1 font-medium text-gray-700">Pengarang</label>
                    <input type="text" name="pengarang" id="pengarang" required
                        value="{{ old('pengarang', $bukuDetail->pengarang ?? '') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
                </div>
                <div class="mb-6 text-sm">
                    <label for="tahun_terbit" class="block mb-1 font-medium text-gray-700">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" required
                        value="{{ old('tahun_terbit', $bukuDetail->tahun_terbit ?? '') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
                </div>
                <button type="submit"
                    class="bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-4 rounded w-full transition cursor-pointer">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        const addBookButton = document.getElementById('addBookButton');
        const addBookForm = document.getElementById('addBookForm');

        addBookButton.addEventListener('click', () => {
            addBookForm.classList.toggle('hidden');
        });
    </script>
</body>

</html>

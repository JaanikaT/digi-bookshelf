@props(['book'])
<a href="{{ route('books.show', $book) }}" class="block hover:scale-[1.03] transition-transform duration-150">

    <div class="book-container flex-shrink-0">
        <div class="book-content">
            @php
                $coverPath = 'storage/' . $book->cover;
            @endphp

            @if($book->cover && file_exists(public_path($coverPath)))
                <img src="{{ asset($coverPath) }}" alt="{{ $book->title }}">
            @else
                <div class="book-placeholder">
                    <div class="title">{{ $book->title }}</div>
                    <div class="author">
                        <ul>
                            @foreach ($book->authors as $author)
                                <li>{{ $author->author }}</li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</a>    
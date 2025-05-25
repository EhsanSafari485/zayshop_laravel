@foreach ($comments as $comment)
    <div class="mb-3 border-bottom pb-2">
        <div class="comment-author">{{ $comment->users->name }}</div>
        <div class="comment-date">{{ \Morilog\Jalali\Jalalian::fromDateTime($comment->created_at)->format('%Y/%m/%d') }}</div>
        <div class="comment-content">{{ $comment->comment }}</div>
    </div>
@endforeach


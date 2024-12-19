@component('mail::message')
# A new comment has been submitted for the course "{{ $comment->commentable->title }}".
Dear instructor, a new comment has been submitted for the course "{{ $comment->commentable->title }}" on the Hemn_org website. Please provide an appropriate response as soon as possible.
@component('mail::panel')
@component('mail::button', ['url' => $comment->commentable->path()])
View Course
@endcomponent
@endcomponent

Thank you, {{ config('app.name') }}
@endcomponent

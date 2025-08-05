<!DOCTYPE html>
<html>
<head>
    <title>Voting Notification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Time to Vote - {{ $competition->title }}</h1>
    
    <p>Hello,</p>
    
    <p>The submission period for the competition "{{ $competition->title }}" has ended. 
    It's time to vote for the best interpretation!</p>
    
    <p>Voting will be open until: {{ $competition->voting_deadline->format('F j, Y g:i A') }}</p>
    
    <p>
        <a href="{{ route('competitions.vote', $competition) }}">Vote Now</a>
    </p>
    
    <p>Thank you,<br>
    The Painting Competition Team</p>
</body>
</html>

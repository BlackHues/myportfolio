NEW PROJECT INQUIRY
====================

From: {{ $senderName }}
Mobile: {{ $senderPhone }}

Project type: {{ $projectTypeLabel }}

@if (!empty($bodyText))
---
Message:
{{ $bodyText }}
---
@endif

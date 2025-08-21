<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
        }

        .header img {
            height: 50px;
            width: auto;
            display: inline-block;
        }

        .title {
            font-weight: bold;
            text-align: center;
            margin-top: 1rem;
        }

        .fields {
            margin-top: 1rem;
        }

        .fields p {
            margin: 0.2rem 0;
        }

        .body-text {
            margin-top: 1rem;
            text-align: justify;
        }

        /* Center image section on page */
        .image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem auto;
            min-height: 400px;
            /* reserve space */
            width: 90%;
        }

        /* Image Section Grid */
        .image-section {
            display: grid;
            gap: 0.8rem;
            justify-items: center;
            align-items: center;
            width: 100%;
        }

        /* All images smaller */
        .image-section img {
            max-width: 70%;
            /* smaller */
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Layout for 1 image */
        .image-section.one {
            grid-template-columns: 1fr;
        }

        .image-section.one img {
            max-height: 200px;
        }

        /* Layout for 2 images */
        .image-section.two {
            grid-template-columns: repeat(2, 1fr);
        }

        .image-section.two img {
            max-height: 180px;
        }

        /* Layout for 3 or 4 images */
        .image-section.three,
        .image-section.four {
            grid-template-columns: repeat(2, 1fr);
        }

        .image-section.three img,
        .image-section.four img {
            max-height: 160px;
        }

        /* Layout for 5 images */
        .image-section.five {
            grid-template-columns: repeat(2, 1fr);
        }

        .image-section.five img {
            max-height: 150px;
        }

        .image-section.five img:nth-child(5) {
            grid-column: 1 / span 2;
            justify-self: center;
        }

        .signature {
    margin-top: 3rem;
    padding-left: 3rem;   /* indent whole block */
    text-align: left;
    width: fit-content;   /* shrink to contents */
}

.signature-line {
    width: 220px;          /* longer line */
    border-top: 1px solid #000;
    margin: 0.2rem 0;
    position: relative;
}

.signature .name,
.signature .label {
    margin: 0.2rem 0;
    width: 220px;          /* same as line width */
    text-align: center;    /* centers text on line */
}

    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/SMI_logo.png') }}" alt="Large Logo">
        <p>Republic of the Philippines
            <br> Municipal Disaster Risk Reduction and Management Office-San Mateo
            <br>VHJP+FJ2, San Mateo, Isabela
            <br>land lines: Globe: 0926-280-3804 SMART: 0961-541-7453
            <br>ndrrmoc@ocd.gov.ph
        </p>
    </div>

    <div class="title">Incident and Crime report</div>

    <div class="fields">
        <p><strong>FOR:</strong> (Demo text)</p>
        <p><strong>SUBJECT:</strong> {{ $report->report_title }}</p>
        <p><strong>DATE:</strong> {{ $report->report_date }}</p>
    </div>

    <hr>

    <div class="body-text">
        {!! nl2br(e($report->report_description)) !!}
    </div>

    <br>
    <hr>
    <br>

    @if ($report->images->count())
        <div class="image-wrapper">
            <div
                class="image-section
                @if ($report->images->count() === 1) one
                @elseif($report->images->count() === 2) two
                @elseif($report->images->count() === 3) three
                @elseif($report->images->count() === 4) four
                @elseif($report->images->count() === 5) five @endif
            ">
                @foreach ($report->images as $image)
                    <img src="{{ public_path('storage/' . $image->file_path) }}">
                @endforeach
            </div>
        </div>
    @endif

    <div class="signature">
        <p class="name">John Doe</p>
        <div class="signature-line"></div>
        <p class="label"><strong>Signature</strong></p>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Travel Inquiry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #0d6efd;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            color: #004bbb;
            margin-bottom: 20px;
        }

        .inquiry-details {
            background-color: #f8f9fa;
            border-left: 4px solid #4a7c59;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .inquiry-details h3 {
            color: #2c5530;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
        }

        .detail-value {
            flex: 1;
            color: #212529;
        }

        .next-steps {
            background-color: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .next-steps h3 {
            color: #2c5530;
            margin-top: 0;
        }

        .next-steps ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .next-steps li {
            margin-bottom: 8px;
        }

        .contact-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .contact-info h3 {
            color: #856404;
            margin-top: 0;
        }

        .contact-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .contact-item {
            flex: 1;
            min-width: 200px;
        }

        .contact-item strong {
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }

        .footer {
            background-color: #2c5530;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 12px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            display: inline-block;
        }

        .social-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .message-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            font-style: italic;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .content {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
            }

            .detail-label {
                min-width: auto;
                margin-bottom: 2px;
            }

            .contact-details {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Explore Trails Ceylon Tours</h1>
            <p>Your Gateway to Extraordinary Sri Lankan Adventures</p>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $inquiry->first_name }} {{ $inquiry->last_name }},
            </div>

            <p>Thank you for reaching out to <strong>Explore Trails Ceylon Tours</strong>! We're thrilled that you're
                considering Sri Lanka for your next adventure, and we're excited to help you create unforgettable
                memories.</p>

            <p>We have successfully received your travel inquiry and our experienced team is already working on crafting
                the perfect itinerary tailored to your preferences.</p>

            <div class="inquiry-details">
                <h3>📋 Your Inquiry Details</h3>
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value">{{ $inquiry->email }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Phone:</div>
                    <div class="detail-value">{{ $inquiry->phone }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Country:</div>
                    <div class="detail-value">{{ $inquiry->country }}</div>
                </div>
                @if($inquiry->date)
                    <div class="detail-row">
                        <div class="detail-label">Preferred Date:</div>
                        <div class="detail-value">{{ $inquiry->date }}</div>
                    </div>
                @endif
                <div class="detail-row">
                    <div class="detail-label">Group Size:</div>
                    <div class="detail-value">{{ $inquiry->group_size }}
                        {{ $inquiry->group_size == 1 ? 'person' : 'people' }}</div>
                </div>
                @if($inquiry->service)
                    <div class="detail-row">
                        <div class="detail-label">Service:</div>
                        <div class="detail-value">{{ $inquiry->service->name }}</div>
                    </div>
                @endif
                @if($inquiry->message)
                    <div class="detail-row">
                        <div class="detail-label">Message:</div>
                        <div class="detail-value">
                            <div class="message-box">{{ $inquiry->message }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="next-steps">
                <h3>🚀 What Happens Next?</h3>
                <ul>
                    <li><strong>Personal Consultation:</strong> Our travel expert will contact you within 24 hours to
                        discuss your requirements in detail</li>
                    <li><strong>Custom Itinerary:</strong> We'll create a personalized travel plan based on your
                        interests, budget, and timeline</li>
                    <li><strong>Expert Guidance:</strong> Get insider tips and recommendations from our local Sri Lankan
                        travel specialists</li>
                    <li><strong>Seamless Planning:</strong> We'll handle all the details so you can focus on getting
                        excited about your trip!</li>
                </ul>
            </div>

            <div class="contact-info">
                <h3>📞 Need Immediate Assistance?</h3>
                <p>Feel free to reach out to us anytime. We're here to help!</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <strong>📧 Email:</strong>
                        admin@exploretrailsceylontours.com
                    </div>
                    <div class="contact-item">
                        <strong>📱 WhatsApp:</strong>
                        +94 70 107 0007
                    </div>
                </div>
            </div>

            <p>Sri Lanka offers incredible diversity - from ancient temples and pristine beaches to lush tea plantations
                and wildlife safaris. We can't wait to show you the wonders of our beautiful island!</p>

            <p>Thank you for choosing Explore Trails Ceylon Tours. We look forward to making your Sri Lankan adventure
                extraordinary!</p>

            <p style="margin-top: 30px;">
                Warm regards,<br>
                <strong>The Explore Trails Ceylon Tours Team</strong><br>
                <em>Your Trusted Travel Partners in Sri Lanka</em>
            </p>
        </div>

        <div class="footer">
            <p><strong>Explore Trails Ceylon Tours</strong></p>
            <p>Creating Unforgettable Sri Lankan Experiences</p>
            <div class="social-links">
                <a href="mailto:contact@exploretrailsceylontours.com">Email</a>
                <a href="https://wa.me/94701070007">WhatsApp</a>
            </div>
            <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                This email was sent because you submitted an inquiry through our website.
                If you have any questions, please contact us at contact@exploretrailsceylontours.com
            </p>
        </div>
    </div>
</body>

</html>

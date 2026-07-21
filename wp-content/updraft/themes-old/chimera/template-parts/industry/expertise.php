<?php
/**
 * Template part for displaying the Industry Expertise section
 * Built from Figma Design "Our Expertise"
 *
 * @package Chimera
 */

// Dynamic ACF/SCF Fields with fallback to the original Figma text
$expertise_section = get_field('expertise_content') ?: [];
$badge_text = $expertise_section['badge_text'] ?? 'Our Expertise';
$heading_line1 = $expertise_section['heading_line_1'] ?? 'AI-led Engineering Solutions';
$heading_highlight = $expertise_section['heading_highlight'] ?? 'for Transforming Financial Services Models';
$description = $expertise_section['description'] ?? 'We bring deep domain expertise across financial services sectors requiring secure transaction processing, regulatory compliance, risk management, and intuitive customer experiences.';

// Use ACF Repeater field if it exists, otherwise use fallback data
$acf_cards = $expertise_section['expertise_cards'] ?? null;
if ( $acf_cards && is_array($acf_cards) && !empty($acf_cards) ) {
    $cards = [];
    foreach ($acf_cards as $card) {
        $cards[] = [
            'title' => $card['title'] ?? '',
            'desc'  => $card['description'] ?? '',
            'img' => $card['img'] ?? '',
        ];
    }
} else {
    // Fallback static cards
    $cards = [
        [
            'title' => 'Payments',
            'desc' => 'Digital banking solutions built for secure, compliant, and high-volume transaction environments. We support merchant payments, utility billing platforms, swipe-enabled mobile transactions, and event-based payment systems through scalable, API-driven architectures.'
        ],
        [
            'title' => 'Lending',
            'desc' => 'Lending platforms designed to support underwriting, credit assessments, and the complete loan lifecycle. From alternative lending models to borrower management and micro-lending initiatives, our solutions improve transparency, compliance, and decision-making.'
        ],
        [
            'title' => 'KYC & Identity Verification',
            'desc' => 'AI in FinTech is transforming how institutions approach identity verification and compliance. Our approach combines document validation, AML screening, risk scoring, and fraud detection with efficient onboarding workflows and regulatory audit trails.'
        ],
        [
            'title' => 'Digital Wallets',
            'desc' => 'Multi-functional digital wallets built for payments, loyalty programs, micro-transactions, and merchant interactions. Our wallet architectures support secure transactions, interoperability, and real-time visibility into balances and account activity.'
        ],
        [
            'title' => 'Crypto & Blockchain',
            'desc' => 'Blockchain applications built for tokenized payments, smart contract automation, and compliance-ready digital asset ecosystems. Our solutions are built to deliver transparency, auditability, scalability, and security across blockchain-based financial operations.'
        ],
        [
            'title' => 'Private Credit & Alternative Lending',
            'desc' => 'Private credit platforms focused on underwriting, portfolio analytics, borrower management, and investor oversight. We support risk monitoring and compliance workflows while providing greater visibility across lending operations.'
        ]
    ];
}
?>

<section class="ind-expertise bg-white w-full py-[60px] md:py-[80px] relative">
    <div class="container">
        
        <!-- Header -->
        <div class="flex flex-col items-center text-center gap-5 mb-[60px]">
            <!-- Badge -->
            <div class="inline-flex font-jost items-center justify-center px-3 h-[32px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] text-xs font-semibold uppercase text-orange whitespace-nowrap">
                <?php echo esc_html( $badge_text ); ?>
            </div>

            <!-- Headings -->
            <h2 class="leading-tight tracking-[-0.12px] flex flex-col items-center">
                <span class="block"><?php echo esc_html( $heading_line1 ); ?></span>
                <span class="block text-orange"><?php echo esc_html( $heading_highlight ); ?></span>
            </h2>

            <!-- Description -->
            <p class="font-sans font-normal text-gray text-base leading-[1.5] max-w-5xl mt-2">
                <?php echo esc_html( $description ); ?>
            </p>
        </div>

        <!-- Grid of Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach( $cards as $card ) : ?>
                <div class="bg-white border border-bordergray rounded-[8px] overflow-hidden flex flex-col h-full">
                    <div class="h-[180px] sm:h-[220px] w-full bg-[radial-gradient(79.17%_79.17%_at_50%_50%,#FFFFFF_0%,#EEEDEE_100%)] relative flex-shrink-0">
                        <?php if ( !empty($card['img']) && is_array($card['img']) && !empty($card['img']['url']) ) : ?>
                            <img class="absolute inset-0 w-full h-full object-contain p-4" src="<?php echo esc_url( $card['img']['url'] ); ?>" alt="<?php echo esc_attr( $card['img']['alt'] ?? $card['title'] ); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="p-6 md:p-[30px] flex flex-col gap-2.5 flex-grow bg-white">
                        <h4 class="font-jost font-semibold text-lg text-dark leading-[1.2]">
                            <?php echo esc_html( $card['title'] ); ?>
                        </h4>
                        <p class="font-sans text-sm font-normal text-gray leading-[1.5]">
                            <?php echo esc_html( $card['desc'] ); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

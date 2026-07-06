-- ============================================================================
--  Policy content update for `pages` (page_desc = English, page_desc_ja = 日本語)
--  Rewritten for the digital-art-print + credits business (Anime & Manga, Pixel,
--  Pop, Street, and Modern Ukiyo-e artworks, sold in Small / Medium / Large tiers).
--  Placeholders: [Company Name] / [Company Email] / [Company Address]
--  Billing-descriptor image: /assets/images/dba.webp
--  Run this against the `digital-art` database (e.g. via phpMyAdmin > SQL).
-- ============================================================================

-- ---------------------------------------------------------------------------
-- PRIVACY POLICY
-- ---------------------------------------------------------------------------
UPDATE `pages` SET
`page_desc` = '<h2>Privacy Policy</h2>
<p>Welcome to [Company Name] (the &ldquo;Website&rdquo;, &ldquo;Platform&rdquo;, &ldquo;we&rdquo;, &ldquo;our&rdquo;, or &ldquo;us&rdquo;). We create and sell premium downloadable digital artwork &mdash; spanning Anime &amp; Manga, Pixel, Pop, Street, and Modern Ukiyo-e collections &mdash; through a credit-based store. This Privacy Policy explains what information we collect, how we use it, and the choices you have. By using the Website or purchasing credits and artwork, you agree to the practices described here.</p>
<ol>
  <li>
    <h3>Information We Collect</h3>
    <p>We collect only the information needed to run the store and deliver your downloads:</p>
    <ul>
      <li>Account details such as your name, email address, and password.</li>
      <li>Order and billing details, including your address and the artworks or credit packs you purchase.</li>
      <li>Payment information, which is handled by our payment provider &mdash; we do not store full card numbers on our servers.</li>
      <li>Credit activity, such as top-ups, bonus credits, and the artworks you redeem.</li>
      <li>Technical data such as your browser, device, and general usage of the Website.</li>
    </ul>
  </li>
  <li>
    <h3>How We Use Your Information</h3>
    <p>We use your information to:</p>
    <ul>
      <li>Deliver the digital artwork and credits you buy and keep them available in your account.</li>
      <li>Process payments, apply tier bonuses, and prevent fraud.</li>
      <li>Provide customer support and respond to your requests.</li>
      <li>Send order confirmations, receipts, and important service notices.</li>
      <li>Improve our collections, the Website, and your browsing experience.</li>
    </ul>
  </li>
  <li>
    <h3>Cookies and Tracking Technologies</h3>
    <p>We use cookies and similar technologies to keep you signed in, remember your cart and currency, and understand how the Website is used. You can control cookies through your browser settings, though some features may not work correctly without them.</p>
  </li>
  <li>
    <h3>How We Share Information</h3>
    <p>We do not sell your personal information. We share it only with trusted parties who help us operate the store, such as payment processors, hosting and email providers, and analytics services &mdash; and only to the extent needed to provide the service. We may also disclose information where required by law.</p>
  </li>
  <li>
    <h3>Data Security</h3>
    <p>We use reasonable technical and organisational measures to protect your information. Payments are processed over secure, encrypted connections. No method of transmission over the internet is completely secure, so we cannot guarantee absolute security.</p>
  </li>
  <li>
    <h3>Your Rights and Choices</h3>
    <p>You may access or update your account details at any time from your dashboard. You may also ask us to correct or delete your personal information, subject to any records we must keep for legal or accounting reasons. To make a request, contact us at [Company Email].</p>
  </li>
  <li>
    <h3>Digital Products and Your Account</h3>
    <p>Purchased credits and downloaded artwork are tied to your account. Please keep your login details private; you are responsible for activity that takes place under your account.</p>
  </li>
  <li>
    <h3>Children&rsquo;s Privacy</h3>
    <p>The Website is intended for adults. We do not knowingly collect information from children. If you believe a child has provided us information, please contact us so we can remove it.</p>
  </li>
  <li>
    <h3>Changes to This Policy</h3>
    <p>We may update this Privacy Policy from time to time. The latest version will always be posted on this page with a revised effective date. Continued use of the Website means you accept the updated Policy.</p>
  </li>
  <li>
    <h3>Contact Us</h3>
    <p>If you have any questions about this Privacy Policy or your information, contact us at [Company Email] or write to us at [Company Address].</p>
  </li>
</ol>',
`page_desc_ja` = '<h2>プライバシーポリシー</h2>
<p>[Company Name]（以下「本ウェブサイト」「プラットフォーム」「当社」といいます）へようこそ。当社は、アニメ・漫画、ピクセル、ポップ、ストリート、現代浮世絵の各コレクションにわたる高品質なダウンロード型デジタルアートを、クレジット制のストアを通じて制作・販売しています。本プライバシーポリシーは、当社が収集する情報、その利用方法、及びお客様の選択肢について説明するものです。本ウェブサイトのご利用、又はクレジットやアートワークのご購入をもって、本ポリシーに記載の取扱いに同意いただいたものとみなします。</p>
<ol>
  <li>
    <h3>収集する情報</h3>
    <p>当社は、ストアの運営とダウンロードの提供に必要な情報のみを収集します。</p>
    <ul>
      <li>お名前、メールアドレス、パスワードなどのアカウント情報。</li>
      <li>ご住所、及びご購入いただいたアートワークやクレジットパックを含む注文・請求情報。</li>
      <li>決済情報。決済代行会社が処理し、当社のサーバーにカード番号の全桁を保存することはありません。</li>
      <li>チャージ、ボーナスクレジット、引き換えたアートワークなどのクレジット利用履歴。</li>
      <li>ブラウザ、デバイス、本ウェブサイトの一般的な利用状況などの技術情報。</li>
    </ul>
  </li>
  <li>
    <h3>情報の利用方法</h3>
    <p>当社は、次の目的でお客様の情報を利用します。</p>
    <ul>
      <li>ご購入いただいたデジタルアートやクレジットを提供し、アカウント内で利用可能に保つため。</li>
      <li>決済処理、ティア（段階）ボーナスの付与、及び不正利用の防止のため。</li>
      <li>カスタマーサポートの提供、及びお問い合わせへの対応のため。</li>
      <li>注文確認、領収書、重要なサービス通知の送信のため。</li>
      <li>コレクション、本ウェブサイト、及び閲覧体験を改善するため。</li>
    </ul>
  </li>
  <li>
    <h3>クッキー及びトラッキング技術</h3>
    <p>当社は、ログイン状態の維持、カートや通貨設定の記憶、及び本ウェブサイトの利用状況の把握のため、クッキー及び類似の技術を使用します。クッキーはブラウザの設定で管理できますが、無効にすると一部の機能が正しく動作しない場合があります。</p>
  </li>
  <li>
    <h3>情報の共有</h3>
    <p>当社はお客様の個人情報を販売しません。ストア運営を支援する信頼できる委託先（決済代行会社、ホスティング及びメール提供者、分析サービスなど）に対し、サービス提供に必要な範囲でのみ共有します。また、法令上必要な場合には情報を開示することがあります。</p>
  </li>
  <li>
    <h3>データの安全管理</h3>
    <p>当社は、お客様の情報を保護するため、合理的な技術的・組織的措置を講じます。決済は暗号化された安全な通信で処理されます。ただし、インターネット上の通信は完全に安全とはいえないため、絶対的な安全性を保証することはできません。</p>
  </li>
  <li>
    <h3>お客様の権利と選択</h3>
    <p>お客様は、ダッシュボードからいつでもアカウント情報を確認・更新できます。また、法令上・会計上の理由により保持が必要な記録を除き、個人情報の訂正又は削除を当社に請求できます。ご請求は [Company Email] までご連絡ください。</p>
  </li>
  <li>
    <h3>デジタル製品とアカウント</h3>
    <p>ご購入いただいたクレジット及びダウンロードしたアートワークは、お客様のアカウントに紐づきます。ログイン情報は第三者に開示せず、アカウントで行われた操作についてはお客様がご責任を負うものとします。</p>
  </li>
  <li>
    <h3>お子様のプライバシー</h3>
    <p>本ウェブサイトは成人の方を対象としています。当社は、お子様から意図的に情報を収集することはありません。お子様が情報を提供したと思われる場合は、削除できるようご連絡ください。</p>
  </li>
  <li>
    <h3>本ポリシーの変更</h3>
    <p>当社は、本プライバシーポリシーを随時改定することがあります。最新版は常に本ページに掲載し、改定日を更新します。改定後も本ウェブサイトのご利用を継続された場合、更新後のポリシーに同意いただいたものとみなします。</p>
  </li>
  <li>
    <h3>お問い合わせ</h3>
    <p>本プライバシーポリシー又はお客様の情報に関するご質問は、[Company Email] までご連絡いただくか、[Company Address] までご郵送ください。</p>
  </li>
</ol>'
WHERE `page_slug` = 'privacy-policy';


-- ---------------------------------------------------------------------------
-- TERMS & CONDITIONS
-- ---------------------------------------------------------------------------
UPDATE `pages` SET
`page_desc` = '<h2>Terms &amp; Conditions</h2>
<p>These Terms &amp; Conditions govern your use of [Company Name] (the &ldquo;Website&rdquo;) and any purchase of credits or digital artwork made through it. By creating an account, buying credits, or downloading artwork, you agree to these Terms. Please read them carefully.</p>
<ol>
  <li>
    <h3>Eligibility and Accounts</h3>
    <p>You must be at least the age of majority in your country to buy from the Website. You are responsible for keeping your account details accurate and your password secure. You are responsible for all activity that occurs under your account.</p>
  </li>
  <li>
    <h3>Credits</h3>
    <p>Our store runs on credits. You purchase credits, then redeem them for digital artwork.</p>
    <ul>
      <li>Larger top-ups may earn bonus credits according to the tier shown at checkout.</li>
      <li>Credits have no cash value, are non-transferable, and cannot be exchanged back into money.</li>
      <li>Credits are added to your balance immediately after a successful payment.</li>
    </ul>
  </li>
  <li>
    <h3>Digital Artwork and Sizes</h3>
    <p>Each artwork is a downloadable digital image offered in multiple tiers &mdash; typically <strong>Small</strong>, <strong>Medium</strong>, and <strong>Large</strong>. Each tier has its own credit price and resolution. The tier you choose determines the file you receive; please select carefully before redeeming.</p>
  </li>
  <li>
    <h3>Licence and Permitted Use</h3>
    <p>When you redeem an artwork, we grant you a personal, non-exclusive, non-transferable licence to download and use the image for your own personal, non-commercial enjoyment &mdash; for example, printing it for your home or using it as personal wallpaper. Unless we agree in writing, you may not resell, redistribute, sublicense, or commercially exploit the artwork, nor claim authorship of it.</p>
  </li>
  <li>
    <h3>Intellectual Property</h3>
    <p>All artwork, designs, text, logos, and other content on the Website remain the property of [Company Name] or its licensors and are protected by copyright and other laws. Buying credits or downloading a file does not transfer ownership of the underlying artwork to you.</p>
  </li>
  <li>
    <h3>Payments and Billing</h3>
    <p>Prices are shown in your selected currency and are payable at checkout. Payments are processed securely by our payment provider. Charges will appear on your card or bank statement under our billing descriptor shown below, so you can recognise the transaction:</p>
    <table>
      <tr><th>Company</th><td>[Company Name]</td></tr>
      <tr><th>Support Email</th><td>[Company Email]</td></tr>
      <tr><th>Billing Descriptor</th><td><img src="/assets/images/dba.webp" alt="[Company Name] billing descriptor" style="max-height:40px;"></td></tr>
    </table>
    <p>If you do not recognise a charge, please contact us at [Company Email] before disputing it with your bank so we can help resolve the matter quickly.</p>
  </li>
  <li>
    <h3>Prohibited Conduct</h3>
    <p>You agree not to misuse the Website. In particular, you must not:</p>
    <ul>
      <li>Copy, scrape, or redistribute our artwork or content without permission.</li>
      <li>Attempt to bypass payment, manipulate credits, or access another user&rsquo;s account.</li>
      <li>Use the Website for any unlawful, infringing, or harmful purpose.</li>
    </ul>
  </li>
  <li>
    <h3>Availability and Changes</h3>
    <p>We may add, update, or remove artworks, collections, and features at any time. We aim to keep the Website available, but we do not guarantee uninterrupted access and may suspend it for maintenance or reasons beyond our control.</p>
  </li>
  <li>
    <h3>Disclaimers and Limitation of Liability</h3>
    <p>The Website and artwork are provided on an &ldquo;as is&rdquo; basis. Colours may vary slightly between screens and prints. To the fullest extent permitted by law, [Company Name] is not liable for any indirect or consequential loss arising from your use of the Website, and our total liability is limited to the amount you paid for the relevant purchase.</p>
  </li>
  <li>
    <h3>Governing Law and Contact</h3>
    <p>These Terms are governed by the laws applicable at the place of business of [Company Name]. For any questions about these Terms, contact us at [Company Email] or [Company Address].</p>
  </li>
</ol>',
`page_desc_ja` = '<h2>利用規約</h2>
<p>本利用規約は、[Company Name]（以下「本ウェブサイト」）のご利用、及び本ウェブサイトを通じたクレジット又はデジタルアートのご購入に適用されます。アカウントの作成、クレジットのご購入、又はアートワークのダウンロードをもって、本規約に同意いただいたものとみなします。内容をよくお読みください。</p>
<ol>
  <li>
    <h3>利用資格とアカウント</h3>
    <p>本ウェブサイトでご購入いただくには、お客様の居住国における成年年齢に達している必要があります。お客様は、アカウント情報を正確に保ち、パスワードを安全に管理する責任を負います。また、アカウントで行われたすべての操作について責任を負うものとします。</p>
  </li>
  <li>
    <h3>クレジット</h3>
    <p>当ストアはクレジット制で運営されています。お客様はクレジットを購入し、それをデジタルアートと引き換えます。</p>
    <ul>
      <li>チャージ額が大きいほど、決済画面に表示されるティアに応じてボーナスクレジットが付与される場合があります。</li>
      <li>クレジットに換金価値はなく、第三者への譲渡や現金への払い戻しはできません。</li>
      <li>クレジットは、決済が正常に完了した直後に残高へ加算されます。</li>
    </ul>
  </li>
  <li>
    <h3>デジタルアートとサイズ</h3>
    <p>各アートワークはダウンロード型のデジタル画像で、通常は<strong>Small（小）</strong>、<strong>Medium（中）</strong>、<strong>Large（大）</strong>の複数のティアで提供されます。各ティアには固有のクレジット価格と解像度があります。選択したティアによって受け取るファイルが決まりますので、引き換え前によくご確認ください。</p>
  </li>
  <li>
    <h3>ライセンスと許諾される利用</h3>
    <p>アートワークを引き換えると、当社はお客様に対し、個人的かつ非独占的で譲渡不能なライセンスを付与します。これにより、お客様は当該画像を個人的・非商業的な用途（例：ご自宅での印刷、個人的な壁紙としての使用）でダウンロード・利用できます。当社の書面による合意がない限り、アートワークの再販売、再配布、サブライセンス、商業的利用、及び著作者であるとの主張は行えません。</p>
  </li>
  <li>
    <h3>知的財産権</h3>
    <p>本ウェブサイト上のすべてのアートワーク、デザイン、テキスト、ロゴその他のコンテンツは、[Company Name] 又はそのライセンサーに帰属し、著作権その他の法律により保護されます。クレジットの購入やファイルのダウンロードによって、原著作物の権利がお客様に移転することはありません。</p>
  </li>
  <li>
    <h3>お支払いと請求</h3>
    <p>価格はお客様が選択された通貨で表示され、決済時にお支払いいただきます。決済は決済代行会社により安全に処理されます。ご請求は、取引をご確認いただけるよう、以下に示す当社の請求ディスクリプタ（明細表示名）でカード又は銀行のご利用明細に表示されます。</p>
    <p><img src="/assets/images/dba.webp" alt="[Company Name] 請求ディスクリプタ" style="max-height:48px;"></p>
    <p>お心当たりのないご請求がある場合は、金融機関へ異議を申し立てる前に [Company Email] までご連絡ください。速やかな解決に向けてお手伝いいたします。</p>
  </li>
  <li>
    <h3>禁止行為</h3>
    <p>お客様は、本ウェブサイトを不正に利用しないことに同意します。特に、次の行為を行ってはなりません。</p>
    <ul>
      <li>許可なく当社のアートワークやコンテンツを複製、収集（スクレイピング）、又は再配布すること。</li>
      <li>決済の回避、クレジットの不正操作、又は他のユーザーのアカウントへのアクセスを試みること。</li>
      <li>違法、権利侵害、又は有害な目的で本ウェブサイトを利用すること。</li>
    </ul>
  </li>
  <li>
    <h3>提供内容の変更</h3>
    <p>当社は、アートワーク、コレクション、及び機能をいつでも追加、更新、又は削除することがあります。当社は本ウェブサイトの提供に努めますが、中断のないアクセスを保証するものではなく、保守その他やむを得ない事由により一時的に停止する場合があります。</p>
  </li>
  <li>
    <h3>免責事項及び責任の制限</h3>
    <p>本ウェブサイト及びアートワークは「現状有姿」で提供されます。色味は画面や印刷環境によってわずかに異なる場合があります。法令が認める最大限の範囲で、[Company Name] は本ウェブサイトの利用に起因する間接的又は結果的損害について責任を負わず、当社の賠償責任の総額は当該購入についてお客様がお支払いになった金額を上限とします。</p>
  </li>
  <li>
    <h3>準拠法及びお問い合わせ</h3>
    <p>本規約は、[Company Name] の事業所所在地において適用される法律に準拠します。本規約に関するご質問は、[Company Email] 又は [Company Address] までご連絡ください。</p>
  </li>
</ol>'
WHERE `page_slug` = 'terms-conditions';


-- ---------------------------------------------------------------------------
-- REFUND POLICY
-- ---------------------------------------------------------------------------
UPDATE `pages` SET
`page_desc` = '<h2>Refund Policy</h2>
<p>This Refund &amp; Cancellation Policy explains when refunds are and are not available for purchases made on [Company Name] (the &ldquo;Website&rdquo;). Because we sell downloadable digital products &mdash; credits and digital artwork &mdash; delivery is instant and cannot be reversed. By purchasing, you agree to this Policy.</p>
<ol>
  <li>
    <h3>Nature of Our Digital Products</h3>
    <p>Everything sold on the Website is a digital product delivered electronically, including:</p>
    <ul>
      <li>Credit top-ups and bonus credits.</li>
      <li>Downloadable digital artwork in Small, Medium, and Large tiers.</li>
    </ul>
    <p>Because these products are delivered instantly and cannot be returned, purchases are generally non-refundable once processed, accessed, or downloaded.</p>
  </li>
  <li>
    <h3>Credit Purchases</h3>
    <p>Purchased credits are non-refundable once payment has been successfully processed and the credits have been added to your balance. Bonus credits awarded through tier promotions likewise have no cash value and are non-refundable.</p>
  </li>
  <li>
    <h3>Artwork Downloads</h3>
    <p>When you redeem credits for an artwork, that transaction is final. As the file is made available immediately, redeemed artwork cannot be refunded or exchanged for a different tier or a different piece. Please review the collection and your chosen size before confirming.</p>
  </li>
  <li>
    <h3>When We May Offer a Refund</h3>
    <p>We will review a refund request in good faith in limited situations, such as:</p>
    <ul>
      <li>You were charged more than once for the same order due to a technical error.</li>
      <li>A payment succeeded but your credits or download were never delivered and we cannot resolve it.</li>
      <li>A confirmed unauthorised transaction on your account.</li>
    </ul>
  </li>
  <li>
    <h3>How to Request a Refund</h3>
    <p>Email us at [Company Email] within 7 days of the charge with your order number and a short description of the issue. We may ask for details to verify the purchase. Approved refunds are returned to your original payment method.</p>
  </li>
  <li>
    <h3>Billing and Statement Descriptor</h3>
    <p>Payments and any approved refunds are handled by our payment provider. Charges and refunds appear on your statement under our billing descriptor shown here, which can help you identify the transaction before contacting your bank:</p>
    <p><img src="/assets/images/dba.webp" alt="[Company Name] billing descriptor" style="max-height:48px;"></p>
  </li>
  <li>
    <h3>Chargebacks</h3>
    <p>If you do not recognise a charge, please contact us first at [Company Email]. Opening a chargeback before contacting us may delay a resolution and can lead to temporary suspension of your account while the dispute is reviewed.</p>
  </li>
  <li>
    <h3>Contact Us</h3>
    <p>For any questions about this Refund Policy, contact us at [Company Email] or [Company Address].</p>
  </li>
</ol>',
`page_desc_ja` = '<h2>返金ポリシー</h2>
<p>本返金・キャンセルポリシーは、[Company Name]（以下「本ウェブサイト」）でのご購入について、返金が可能な場合と不可能な場合を説明するものです。当社はダウンロード型のデジタル製品（クレジット及びデジタルアート）を販売しており、提供は即時に行われ、取り消すことができません。ご購入をもって、本ポリシーに同意いただいたものとみなします。</p>
<ol>
  <li>
    <h3>デジタル製品の性質</h3>
    <p>本ウェブサイトで販売されるものはすべて、電子的に提供されるデジタル製品です。次のものが含まれます。</p>
    <ul>
      <li>クレジットのチャージ及びボーナスクレジット。</li>
      <li>Small（小）、Medium（中）、Large（大）の各ティアで提供されるダウンロード型デジタルアート。</li>
    </ul>
    <p>これらの製品は即時に提供され、返品ができないため、処理・アクセス・ダウンロードが完了した後は、原則として返金の対象外となります。</p>
  </li>
  <li>
    <h3>クレジットの購入</h3>
    <p>購入されたクレジットは、決済が正常に処理され残高に加算された後は返金できません。ティアプロモーションにより付与されたボーナスクレジットも同様に換金価値はなく、返金の対象外です。</p>
  </li>
  <li>
    <h3>アートワークのダウンロード</h3>
    <p>クレジットをアートワークに引き換えた取引は最終的なものです。ファイルは直ちに利用可能となるため、引き換え済みのアートワークについて、返金や、別のティア・別の作品への交換はできません。確定前に、コレクションと選択したサイズをよくご確認ください。</p>
  </li>
  <li>
    <h3>返金に応じる場合</h3>
    <p>当社は、次のような限定的な状況においては、誠実に返金のご請求を検討します。</p>
    <ul>
      <li>技術的なエラーにより、同一の注文に対して重複して請求された場合。</li>
      <li>決済は成立したものの、クレジット又はダウンロードが提供されず、当社でも解決できない場合。</li>
      <li>お客様のアカウントにおける、確認された不正取引の場合。</li>
    </ul>
  </li>
  <li>
    <h3>返金のご請求方法</h3>
    <p>ご請求は、ご請求日から7日以内に、注文番号と問題の概要を添えて [Company Email] までメールでご連絡ください。購入内容の確認のため、詳細をお伺いする場合があります。承認された返金は、元のお支払い方法へ返金されます。</p>
  </li>
  <li>
    <h3>請求及び明細表示名</h3>
    <p>お支払い及び承認された返金は、決済代行会社が処理します。ご請求及び返金は、金融機関へご連絡いただく前に取引を識別しやすいよう、以下に示す当社の請求ディスクリプタでご利用明細に表示されます。</p>
    <p><img src="/assets/images/dba.webp" alt="[Company Name] 請求ディスクリプタ" style="max-height:48px;"></p>
  </li>
  <li>
    <h3>チャージバックについて</h3>
    <p>お心当たりのないご請求がある場合は、まず [Company Email] までご連絡ください。ご連絡の前にチャージバックを申請されますと、解決が遅れるほか、異議申立ての審査中にアカウントが一時的に停止される場合があります。</p>
  </li>
  <li>
    <h3>お問い合わせ</h3>
    <p>本返金ポリシーに関するご質問は、[Company Email] 又は [Company Address] までご連絡ください。</p>
  </li>
</ol>'
WHERE `page_slug` = 'refund-policy';


-- ---------------------------------------------------------------------------
-- DELIVERY POLICY
-- ---------------------------------------------------------------------------
UPDATE `pages` SET
`page_desc` = '<h2>Delivery Policy</h2>
<p>This Delivery Policy explains how you receive your purchases from [Company Name] (the &ldquo;Website&rdquo;). We sell downloadable digital products only &mdash; credits and digital artwork across our Anime &amp; Manga, Pixel, Pop, Street, and Modern Ukiyo-e collections. There is no physical shipping.</p>
<ol>
  <li>
    <h3>Digital Delivery Only</h3>
    <p>All products are delivered electronically through your account on the Website. Nothing is posted or couriered, so no shipping address or delivery fee applies.</p>
  </li>
  <li>
    <h3>Credit Delivery</h3>
    <p>When you top up, your credits are added to your account balance immediately after your payment is confirmed. You can then use them to redeem any artwork in the store.</p>
  </li>
  <li>
    <h3>Artwork Downloads and Sizes</h3>
    <p>After you redeem credits for an artwork, the digital file becomes available to download from your account. Each artwork is offered in <strong>Small</strong>, <strong>Medium</strong>, and <strong>Large</strong> tiers, and you receive the file for the tier you selected.</p>
  </li>
  <li>
    <h3>Delivery Timeframe</h3>
    <p>Delivery is normally instant. During periods of very high traffic, confirmation may take a little longer; if so, your credits and downloads will appear in your account once processing completes. You can re-download purchased artwork from your account at any time.</p>
  </li>
  <li>
    <h3>Technical Requirements</h3>
    <p>To receive your downloads you need a compatible device, an up-to-date browser, and a stable internet connection. Large files may take longer to download on slower connections.</p>
  </li>
  <li>
    <h3>Failed or Delayed Delivery</h3>
    <p>If a payment has been taken but your credits or download have not appeared after a reasonable time, please contact us at [Company Email] with your order number so we can restore access promptly.</p>
  </li>
  <li>
    <h3>Contact Us</h3>
    <p>For any questions about delivery, contact us at [Company Email] or [Company Address].</p>
  </li>
</ol>',
`page_desc_ja` = '<h2>配信ポリシー</h2>
<p>本配信ポリシーは、[Company Name]（以下「本ウェブサイト」）でのご購入品をお客様がどのように受け取るかを説明するものです。当社は、アニメ・漫画、ピクセル、ポップ、ストリート、現代浮世絵の各コレクションにわたるクレジット及びデジタルアートといった、ダウンロード型のデジタル製品のみを販売しています。物理的な配送はございません。</p>
<ol>
  <li>
    <h3>デジタル配信のみ</h3>
    <p>すべての製品は、本ウェブサイト上のお客様のアカウントを通じて電子的に提供されます。郵送や宅配は行わないため、配送先住所や送料は発生しません。</p>
  </li>
  <li>
    <h3>クレジットの付与</h3>
    <p>チャージを行うと、決済の確認後直ちにクレジットがアカウント残高に加算されます。その後、ストア内の任意のアートワークの引き換えにご利用いただけます。</p>
  </li>
  <li>
    <h3>アートワークのダウンロードとサイズ</h3>
    <p>クレジットをアートワークに引き換えると、そのデジタルファイルをアカウントからダウンロードできるようになります。各アートワークは <strong>Small（小）</strong>、<strong>Medium（中）</strong>、<strong>Large（大）</strong> の各ティアで提供され、選択したティアのファイルを受け取ります。</p>
  </li>
  <li>
    <h3>提供までの時間</h3>
    <p>提供は通常即時です。アクセスが非常に集中する時間帯には、確認に少しお時間をいただく場合があります。その場合でも、処理が完了次第、クレジット及びダウンロードがアカウントに表示されます。ご購入済みのアートワークは、いつでもアカウントから再ダウンロードいただけます。</p>
  </li>
  <li>
    <h3>技術的な要件</h3>
    <p>ダウンロードを受け取るには、対応デバイス、最新のブラウザ、及び安定したインターネット接続が必要です。大きなファイルは、通信速度が遅い環境ではダウンロードに時間がかかる場合があります。</p>
  </li>
  <li>
    <h3>提供の失敗又は遅延</h3>
    <p>決済が完了しているにもかかわらず、相当の時間が経過してもクレジット又はダウンロードが表示されない場合は、注文番号を添えて [Company Email] までご連絡ください。速やかにアクセスを回復いたします。</p>
  </li>
  <li>
    <h3>お問い合わせ</h3>
    <p>配信に関するご質問は、[Company Email] 又は [Company Address] までご連絡ください。</p>
  </li>
</ol>'
WHERE `page_slug` = 'delivery-policy';

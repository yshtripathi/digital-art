@extends('frontend.layouts.main')
@section('title','New Courses|| Instructor')
@section('main-content')
<!-- Start main-content -->
<section class="page-title" style="background-image: url({{url('assets/images/background/page-title.jpg')}});">
	<div class="auto-container">
		<div class="title-outer">
			<h1 class="title">{{ __('common.instructors') }} </h1>
			<ul class="page-breadcrumb">
				<li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
				<li><a href="#"> {{ __('common.instructors') }}  </a></li>				
			</ul>
		</div>
	</div>
</section>
<!-- end main-content -->

<section class="instructor-info">
	<div class="container">
          @if(session('app_locale') == 'ja')
		<div class="page-cntnt p-5 border shadow bg-white">
			<h4>私たちのインストラクターをご紹介します</h4>
<p><strong>業界のリーダー。情熱的な教育者。実践的な経験。</strong></p>
<p>
<strong>Learnmtx.com</strong>のインストラクターは、単なる教師ではありません。彼らは経験豊富なプロフェッショナルであり、イノベーターであり、メンターです。グローバルな専門知識と実践的な洞察をすべてのコースに取り入れています。ソフトウェア開発、データ分析、サイバーセキュリティ、クラウド、デザイン、生産性ツールなど、多様なバックグラウンドを持ち、実社会で役立つ知識を提供することに尽力しています。
</p>
<p>
各インストラクターは、その分野での卓越した知識と、初心者から上級者まであらゆるレベルの学習者を惹きつけ、刺激し、導く能力を持つかどうかを慎重に選ばれています。彼らの指導スタイルは、分かりやすい説明と実践的な学習、プロジェクトベースの演習、実際のシナリオを組み合わせ、学生が即戦力となるスキルを身につけられるようにしています。
</p>

<h5>インストラクターチームには以下の専門家が含まれます：</h5>
<ul>
<li><strong>ソフトウェアエンジニアおよび開発者</strong>：Python、Java、C++、モバイル開発、フルスタックエンジニアリング、RustやGoなどの新興言語に精通した大手テック企業出身の専門家。</li>
<li><strong>データサイエンティストおよびアナリスト</strong>：Python、R、Power BI、SQL、Tableau、機械学習に熟練し、洞察に基づく意思決定力を育成します。</li>
<li><strong>サイバーセキュリティ専門家およびエシカルハッカー</strong>：Kali LinuxやMetasploitなどの実践的なツールを用いたネットワーク防御、ペネトレーションテスト、マルウェア分析、エシカルハッキングのトレーニングを提供。</li>
<li><strong>クラウドアーキテクトおよびDevOpsエンジニア</strong>：AWS、Azure、GCPの認定を持ち、Docker、Kubernetes、Terraform、Jenkinsによる実際のデプロイ経験と自動化ワークフローを共有。</li>
<li><strong>AIおよび機械学習研究者</strong>：TensorFlow、NLP、ディープラーニング、コンピュータビジョン、チャットボット開発の経験を持ち、最先端技術と責任あるAI実践を重視。</li>
<li><strong>UI/UXデザイナーおよびウェブクリエイター</strong>：Figma、Tailwind、WordPress、Adobe XDなどのツールに精通し、デザイン思考やユーザーリサーチの経験を持つ専門家。</li>
<li><strong>ITサポートおよびネットワーク専門家</strong>：Ciscoシステム、CompTIA規格、Linux/Windowsサーバー管理、クラウドネットワークに関する実践的な知識を持つプロフェッショナル。</li>
<li><strong>生産性およびオフィスツールの専門家</strong>：Excel、PowerPoint、Word、Google Workspace、Trello、プロジェクト管理ツールなどの必須ソフトウェアを習得するサポートを提供。</li>
</ul>
<p style="margin-top:20px">
<strong>新しいキャリアの準備、現在のスキルセットの向上、またはまったく新しい分野への挑戦など、どんな目的でも、私たちのインストラクターが誠実さ、明確さ、情熱を持ってあなたの学びの旅をサポートします。</strong>
</p>

	</div>
        @else
        <div class="page-cntnt p-5 border shadow bg-white">
			<h4>Meet Our Instructors</h4>
			<p><strong>Industry Leaders. Passionate Educators. Real-World Experience.</strong></p>
			<p>At <strong>Learnmtx.com</strong>, our instructors are more than just teachers — they are seasoned professionals, innovators, and mentors who bring global expertise and practical insight into every course. With diverse backgrounds spanning software development, data analytics, cybersecurity, cloud, design, and productivity tools, they are committed to delivering knowledge that translates into real-world success.</p>
			
			<p>Each instructor is carefully selected for their mastery in the subject area and their ability to engage, inspire, and guide learners at every level — from complete beginners to advanced professionals. Their teaching style combines clear explanations with hands-on learning, project-based exercises, and real-life scenarios that help students build job-ready skills.</p>

			<h5>Our Instructor Team Includes:</h5>
			<ul>
<li><strong>Software Engineers & Developers</strong> from top tech firms, bringing expertise in Python, Java, C++, mobile development, full-stack engineering, and emerging languages like Rust and Go.</li>
<li><strong>Data Scientists & Analysts</strong> skilled in Python, R, Power BI, SQL, Tableau, and machine learning — helping learners build insight-driven decision-making abilities.</li>
<li><strong>Cybersecurity Experts & Ethical Hackers</strong> with practical training in network defense, penetration testing, malware analysis, and ethical hacking using real tools like Kali Linux and Metasploit.</li>
<li><strong>Cloud Architects & DevOps Engineers</strong> certified in AWS, Azure, and GCP, sharing real deployment experience and automation workflows with Docker, Kubernetes, Terraform, and Jenkins.</li>
<li><strong>AI & ML Researchers</strong> with backgrounds in TensorFlow, NLP, deep learning, computer vision, and chatbot development, emphasizing cutting-edge technology and responsible AI practices.</li>
<li><strong>UI/UX Designers & Web Creators</strong> with hands-on design thinking skills, user research experience, and technical fluency in tools like Figma, Tailwind, WordPress, and Adobe XD.</li>
<li><strong>IT Support & Networking Professionals</strong> with real-world knowledge in Cisco systems, CompTIA standards, Linux/Windows server administration, and cloud-based networking.</li>
<li><strong>Productivity & Office Tool Experts</strong> helping learners master essential software like Excel, PowerPoint, Word, Google Workspace, Trello, and project management tools.</li>
</ul>
			<p style="margin-top:20px"><strong>Whether you're preparing for a new career, enhancing your current skill set, or exploring something entirely new — our instructors are here to guide your journey with authenticity, clarity, and passion.</strong></p>
			
	</div>
        @endif  
    </div>
</section>


@endsection
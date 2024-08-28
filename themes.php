<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="imgs/wosc.ico">
    <style>
        .accordion {
            margin: auto;
        }
        .accordion input {
            display: none;
        }
        .box {
            position: relative;
            padding: auto;
            background: white;
            height: 64px;
            transition: all .15s ease-in-out;
        }
        .box::before {
            content: '';
            position: absolute;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            pointer-events: none;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px rgba(0,0,0,.12),0 2px 4px rgba(0,0,0,.24);
        }
        header.box {
            background: #084466;
            z-index: 100;
            cursor: initial;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px -2px rgba(0,0,0,.12),0 2px 4px -4px rgba(0,0,0,.24);
        }
        header .box-title {
            margin: 0;
            font-weight: normal;
            font-size: 16pt;
            color: white;
            cursor: initial;
            text-align: center;
        }
        .box-title {
            width: calc(100% - 40px);
            height: 64px;
            line-height: 64px;
            padding: 0 20px;
            display: inline-block;
            cursor: pointer;
            -webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;
        }
        .box-content {
            width: calc(100% - 40px);
            padding: 30px 20px;
            font-size: 11pt;
            color: rgba(0,0,0,.54);
            display: none;
        }
        .box-close {
            position: absolute;
            height: 64px;
            width: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
            display: none;
        }
        input:checked + .box {
            height: auto;
            margin: 16px 0;
            box-shadow: 0 0 6px rgba(0,0,0,.16),0 6px 12px rgba(0,0,0,.32);
        }
        input:checked + .box .box-title {
            border-bottom: 1px solid rgba(0,0,0,.18);
        }
        input:checked + .box .box-content,
        input:checked + .box .box-close {
            display: inline-block;
        }
        .arrows section .box-title {
            padding-left: 44px;
            width: calc(100% - 64px);
        }
        .arrows section .box-title:before {
            position: absolute;
            display: block;
           /* content: '\203a';*/
            font-size: 18pt;
            left: 20px;
            top: -2px;
            transition: transform .15s ease-in-out;
            color: rgba(0,0,0,.54);
        }
        input:checked + section.box .box-title:before {
            transform: rotate(90deg);
        }

    </style>
</head>
<body>

<?php include_once("header.php"); ?>
<div id="columnA">
    <h2>Focal Theme: Sustainable Utilization of Oceans in Blue Economy</h2>
    <div class="columnA">
        <p>The theme of the WOSC 2024 ‘<b>Sustainable Utilization of Oceans in Blue Economy</b>’ focuses on the development of coastal infrastructure, tourism in coastal states & islands, offshore & coastal fisheries, marine biotechnology, warming of oceans, sea level rise, depletion of oxygen & acidification, marine pollution, oceanic hazards and mitigation, etc. </p>
        <p>The sustainable utilization of oceans in the Blue Economy is not just an environmental imperative but also a significant economic opportunity. By adhering to principles of ecosystem-based management, social inclusivity, technological innovation, and responsible practices, we can strike a balance between economic development and environmental stewardship. The oceans, when managed wisely, can continue to provide food, energy, and economic prosperity for current and future generations while preserving the beauty and biodiversity of our blue planet.</p>
		<b><p style="color: darkblue">The sessions are being planned under the following sub-themes: </p></b>
        <nav class="accordion arrows">
            <header class="box">
                <label for="acc-close" class="box-title">Sub-Themes</label>
            </header>
            <input type="radio" name="accordion" id="cb1">
            <section class="box">
                <label class="box-title" for="cb1">1. Fisheries with a special focus on offshore cage culture technology and policy.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Coordinator: <b style="color:blue;">Dr. R. Kirubagaran, NIOT (Rtd.)</b></div>
            </section>
            <input type="radio" name="accordion" id="cb2">
            <section class="box">
                <label class="box-title" for="cb2">2. Tourism: Development of Tourism in coastal states and islands and policy.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Coastal areas and Islands with their enticing coastlines, pristine beaches and waters are a major attraction to many tourists. Coastal tourism forms an important part of global tourism industry, and for island nations this sector often defines their gross domestic product. With Tourism emerging as a source of income and economy booster for may Island nations, sustainable development and management of the coasts is of increasing concern to the Governments. Maintaining the critical balance between economy and environmental protection is the need of the hour, as coastal states bear the brunt of natural calamities, with climate change and global warming. A balanced policy for the growth and environment protection helps the local communities, Nation and tourists
            <br><br>Coordinator: <b style="color:blue;">Dr. R.Ramesh, NCSCM, Anna University</b></div>
            </section>
            <input type="radio" name="accordion" id="cb3">
            <section class="box">
                <label class="box-title" for="cb3">3. Ocean services: existing and required</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >Coordinator: <b style="color:blue;">Dr. Balakrishnan Nair, INCOIS</b></div>
            </section>
            <input type="radio" name="accordion" id="cb4">
            <section class="box">
                <label class="box-title" for="cb4">4. Ocean observations, processes and modelling.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Understanding the ocean is increasingly becoming important not only from the perspective of the weather and climate but also for the livelihood, health and wellbeing of the mankind. As the oceans are being utilized more and more for food, energy, water, minerals and medicine, humans are causing irreversible changes. A sustainable use of marine resources would call for a greater understanding of the ocean and its functioning as an integral part of the earth-ocean-atmosphere system.With global warming and climate change looming large and threatening the very existence of the human race, mankind is frantically searching for an appropriate adaptation and mitigation strategy to counter the climate change impact. It is in this context that the present theme assumes importance. A deeper understanding of the ocean would require a detailed knowledge of the ocean processes and ocean-atmosphere interactions on a variety of time scales spanning from days to several decades and centuries. In addition, a detailed understanding of intricate interactions between physical, chemical and biological processes in the ocean is a pre-requisite for aholistic understanding of the function of the ocean. Thus, there is an urgent need to understand oceans through its processes and the tools for such understanding are the ocean observations, both in-situ and remote sensing, and modeling. Through this theme we aim at providing a platform for the peers, experts, scientists, and students and bring them together to come and deliberate on the topic. The understanding emerging out of this deliberations would benefit the society at large in the sustainable use of oceans. 
                <!-- <img src="imgs/wosc24_marine1.png" /> -->
                <a href="https://marine.copernicus.eu/news/monitoring-marine-coastal-hazards-earth-observations-and-copernicus-data" target="_blank">https://marine.copernicus.eu/news/monitoring-marine-coastal-hazards-earth-observations-and-copernicus-data</a>
               <br><br>
               Coordinator: <b style="color:blue;">Dr. Prasanna Kumar, NIO &
Dr. Pattabhi Rama Rao, INCOIS
</b>
            </div>
            </section>
            <input type="radio" name="accordion" id="cb5">
            <section class="box">
                <label class="box-title" for="cb5">5. Harnessing of marine mineral and other resources: Exploration and EIA perspectives.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">
               Coordinator: <b style="color:blue;">Dr. John Kurian, NCPOR</b></div>
            </section>
            <input type="radio" name="accordion" id="cb6">
            <!-- <section class="box">
                <label class="box-title" for="cb6">6. Ocean Summit: Interactions with neighboring countries. (Hybrid)</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content"></div>
            </section> -->
            <section class="box">
                <label class="box-title" for="cb6">6. Underwater Domain Awareness.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >
                In the contemporary global landscape, there is a growing recognition of the crucial role played by the underwater sphere and freshwater systems in driving economic expansion and maintaining climate equilibrium. These aquatic domains, particularly the underwater commons, have emerged as vital trade routes facilitating nearly 90% of global trade. The imperative for sustainable and efficient transportation infrastructure to support these routes is now at the forefront of international priorities. Furthermore, the untapped potential of deep-sea resources, spanning both biological and non-biological elements, demands focused exploration due to their substantial economic and strategic significance. Addressing global challenges such as food and energy security is increasingly linked to the responsible utilization of oceanic and freshwater resources. However, the pursuit of access and control over these resources may also raise concerns about potential competition and conflicts among coastal nations.
                The heightened awareness of the strategic importance of underwater security has led to an increased naval presence in the underwater commons. Simultaneously, freshwater systems hold comparable significance, necessitating effective governance mechanisms built on a foundation of comprehensive situational awareness.The Underwater Domain Awareness (UDA) emerges as a crucial framework for advancing our understanding and application of knowledge in this context. UDA encompasses four pivotal domains: underwater security, the blue economy, environmental and disaster management, and science and technology.
                Recent geopolitical dynamics have witnessed strategic shifts towards the tropical coastal waters of the Indo-Pacific region, with non-regional powers positioning themselves strategically. This includes deploying military assets and research vessels to establish effective UDA. The Indian Ocean Region (IOR) is particularly susceptible due to its unique socio-political and socio-economic characteristics. Security concerns related to underwater terrorism and piracy are pervasive, with non-state actors operating in cooperation with local governments. Extra-regional powers deeply influence the region's domestic politics, potentially manipulating governance mechanisms as needed. The existing regional underwater framework demonstrates limited coherence with long-term national interests, posing challenges despite the IOR's high population density and rapidly growing population.
                <img src="images/uda_theme11_img.png">
                <br>The Underwater Domain Awareness (UDA) Framework, presents a novel and comprehensive approach that combines policy and technological interventions with the enhancement of acoustic capabilities and capacity. What distinguishes this framework is its role as a unifying platform, bringing together stakeholders involved in strategic security, the blue economy, sustainability, climate change management, and digital transformation. In the complex democracy of India, where concerns about the fragmentation of stakeholders often arise, this collaborative approach encourages synergy among stakeholders. The structural framework of UDA holds the potential to facilitate a seamless transformation in governance processes, enhancing transparency and accountability. Most notably, the UDA framework is poised to effectively address the myriad challenges and opportunities presented by the unique tropical littoral waters within the ever-evolving geopolitical and geostrategic realities of the region.
                <br><br>Coordinator: <b style="color:blue;">Smt. J. Cathrine, MRC</b></div>
            </section>
            <input type="radio" name="accordion" id="cb7">
            <section class="box">
                <label class="box-title" for="cb7">7. Policy requirements for sustainable utilization of ocean.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">The oceans are the huge source of different resources and has a great impact on our planet's ecosystem. The oceanic resources will prove very useful for our future generation's needs of Energy, food and materials. To utilize the resources from ocean without harming the ecosystems and marine systems, policies and frameworks are needed to be implemented and executed. Sustainable use of the resources can be ensured by formulating policies based on scientific needs
               <br><br>Coordinator: <b style="color:blue;">Dr. M. A. Atmanand, Former Director, NIOT</b></div>
            </section>
            <input type="radio" name="accordion" id="cb8">
            <section class="box">
                <label class="box-title" for="cb8">8. Ocean technologies for sustainable development.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Ocean Technology is the key to a sustainable future as the ocean holds the biggest potential in achieving various global sustainable development goals. Scientific understanding of the ocean resources paves the way towards development developing technologies and engineering solutions which are environmentally friendly. The conference will address a large scope of cutting-edge technologies, challenges and emerging trends in the overall realm of sustainable development. It would cover following topics:
                <ul>
                    <li>Autonomous and submersible systems</li>
                    <li>Underwater acoustics and imaging</li>
                    <li>Development of ocean sensors</li>
                    <li>Deep sea exploration</li>
                    <li>Renewable ocean energy </li>
                    <li>Maritime transportation</li>
                    <li>Advanced data processing including machine learning and artificial intelligence</li>
            </ul><br>

            Coordinator: <b style="color:blue;">Dr. Purnima Jalihal, NIOT</b>
                </div>
            </section>
            <input type="radio" name="accordion" id="cb9">
            <section class="box">
                <label class="box-title" for="cb9">9. Coastal protection and restoration of coasts.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >Coordinator: <b style="color:blue;">Dr. Tune Usha, NCCR</b></div>
            </section>
            <input type="radio" name="accordion" id="cb10">
            <section class="box">
                <label class="box-title" for="cb10">10. Marine biodiversity and ocean ecosystem.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;">Marine biodiversity, the variety of life in the ocean and seas, is a critical aspect of all three pillars of sustainable development—economic, social and environmental—supporting the healthy functioning of the planet and providing services that underpin the health, well¬-being and prosperity of humanity. The ocean is one of the main repositories of the world's biodiversity. It constitutes over 90 per cent of the habitable space on the planet and contains some 250,000 known species, with many more remaining to be discovered—at least two thirds of the world's marine species are still unidentified. Protecting biodiversity and the essential ecosystem services it supports has become a priority for the scientific community, resource managers, and national and international policy agreements, including the Convention on Biological Diversity (CBD).  They advocate for systematic inventorisation and documentation of biodiversity for conservation and sustainable utilisation of the marine living resources.<br><br>
                India with a vast coastline of 7500km, and its exclusive economic zones (EEZ) extending over 2.2 million square km has a wide variety of ecosystems such as estuaries, coral reefs, marshes, lagoons, sandy and rocky beaches, mangrove forests and sea grass beds, all known for their high biological productivity. They are important sources of ecosystem services and food and jobs for significant portions of the global population. Environmental problems concerning marine ecosystems include unsustainable exploitation of marine resources (for example overfishing of certain species), marine pollution, climate change, and building on coastal areas. Moreover, much of the carbon dioxide causing global warming and heat captured by global warming are absorbed by the ocean, ocean chemistry is changing through processes like ocean acidification which in turn threatens marine ecosystems. Because of the opportunities in marine ecosystems for humans and the threats created by humans, the international community has prioritized "Life below water" as Sustainable Development Goal 14. The goal is to "Conserve and sustainably use the oceans, seas and marine resources for sustainable development". The centrality of marine biodiversity to sustainable development was recognized in the 2030 Agenda for Sustainable Development and the Sustainable Development Goals (SDGs), in which global leaders highlighted the urgency of taking action to improve the conservation and sustainable use of marine biodiversity.<br><br>
                Against this backdrop, there is an urgent need to understand the effects ofmultiple stressors on ocean ecosystems and develop solutions to monitor, protect, manage andrestore ecosystems and their biodiversity under changing environmental, social and climateconditions. The subtheme “Marine biodiversity and ocean ecosystems” address various challenges and suggests way forward to tackle these issues. 
            <br><br>Coordinator: <b style="color:blue;">Dr. Sherin, CMLRE</b>
            </div>
            </section>
            <!-- <input type="radio" name="accordion" id="cb11">
            <section class="box">
                <label class="box-title" for="cb11">11. Underwater Domain Awareness.</label>
                <label class="box-close" for="acc-close"></label>
                <div class="box-content" style="color:black;" >
                In the contemporary global landscape, there is a growing recognition of the crucial role played by the underwater sphere and freshwater systems in driving economic expansion and maintaining climate equilibrium. These aquatic domains, particularly the underwater commons, have emerged as vital trade routes facilitating nearly 90% of global trade. The imperative for sustainable and efficient transportation infrastructure to support these routes is now at the forefront of international priorities. Furthermore, the untapped potential of deep-sea resources, spanning both biological and non-biological elements, demands focused exploration due to their substantial economic and strategic significance. Addressing global challenges such as food and energy security is increasingly linked to the responsible utilization of oceanic and freshwater resources. However, the pursuit of access and control over these resources may also raise concerns about potential competition and conflicts among coastal nations.
                The heightened awareness of the strategic importance of underwater security has led to an increased naval presence in the underwater commons. Simultaneously, freshwater systems hold comparable significance, necessitating effective governance mechanisms built on a foundation of comprehensive situational awareness.The Underwater Domain Awareness (UDA) emerges as a crucial framework for advancing our understanding and application of knowledge in this context. UDA encompasses four pivotal domains: underwater security, the blue economy, environmental and disaster management, and science and technology.
                Recent geopolitical dynamics have witnessed strategic shifts towards the tropical coastal waters of the Indo-Pacific region, with non-regional powers positioning themselves strategically. This includes deploying military assets and research vessels to establish effective UDA. The Indian Ocean Region (IOR) is particularly susceptible due to its unique socio-political and socio-economic characteristics. Security concerns related to underwater terrorism and piracy are pervasive, with non-state actors operating in cooperation with local governments. Extra-regional powers deeply influence the region's domestic politics, potentially manipulating governance mechanisms as needed. The existing regional underwater framework demonstrates limited coherence with long-term national interests, posing challenges despite the IOR's high population density and rapidly growing population.
                <img src="images/uda_theme11_img.png">
                <br>The Underwater Domain Awareness (UDA) Framework, presents a novel and comprehensive approach that combines policy and technological interventions with the enhancement of acoustic capabilities and capacity. What distinguishes this framework is its role as a unifying platform, bringing together stakeholders involved in strategic security, the blue economy, sustainability, climate change management, and digital transformation. In the complex democracy of India, where concerns about the fragmentation of stakeholders often arise, this collaborative approach encourages synergy among stakeholders. The structural framework of UDA holds the potential to facilitate a seamless transformation in governance processes, enhancing transparency and accountability. Most notably, the UDA framework is poised to effectively address the myriad challenges and opportunities presented by the unique tropical littoral waters within the ever-evolving geopolitical and geostrategic realities of the region.
                <br><br>Coordinator: <b style="color:blue;">Smt. J. Cathrine, MRC</b></div>
            </section> --> 
            <input type="radio" name="accordion" id="acc-close">
        </nav>
    </div>
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>
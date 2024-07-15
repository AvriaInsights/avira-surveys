
<style>
    .hero{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
background: #f6faff;
overflow: hidden;
max-height: 53.125em;
padding: 0px;
height: 40em;
flex-direction: row;
}

.caption{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
flex: 0 1 50%;
padding: 0em 2.5625em 0em 0em;
justify-content: flex-end;
}

.caption-wrapper{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
flex-direction: column;
height: inherit;
justify-content: center;
max-width: 39em;
margin-left: 1.5em;
opacity: 1;
}

.wrapper-title{
  -webkit-font-smoothing: antialiased;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
margin: 0;
font-weight: 600;
color: #0d3051;
letter-spacing: -0.03em;
margin-bottom: 17px;
line-height: 64px;
font-size: 3.5em;
}

.container{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
width: 100%;
display: flex;
justify-content: center;
transition: all 0.5s ease-in-out;
padding: 0em;
margin-bottom: 0.97562em;
}

.scrollingCard{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
background: #ffffff;
flex-direction: column;
max-width: 32.3125em;
width: 100%;
border-radius: 0.4125em;
border: 0.05em solid #f9f9f9;
transition: all 0.5s ease-in-out;
height: 8em;
box-shadow: 0px 2px 10px -3px #ccd6e3;
}

.top{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
align-items: center;
padding: 0em 1.67938em 0em 1.99937em;
transition: all 0.5s ease-in-out;
flex: 0 0 5.25em;
}

.wrapper{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
width: 100%;
align-items: flex-end;
justify-content: space-between;
}

.title{
  -webkit-font-smoothing: antialiased;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
margin: 0;
font-weight: 600;
letter-spacing: -0.02em;
transition: all 0.5s ease-in-out;
font-size: 1.5em;
color: #0d3051;
}

.info{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
font-weight: 600;
align-items: baseline;
padding-bottom: 0.125em;
justify-content: flex-end;
}

.lead{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
line-height: 1.5;
transition: all 0.5s ease-in-out;
color: #8294aa;
font-size: 0.5625em;
}

.cost{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
line-height: 1.5;
color: #055daf;
padding-left: 0.625em;
transition: all 0.5s ease-in-out;
font-size: 1.125em;
}

.bottom{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
flex-grow: 1;
background: #fbfbfb;
align-items: center;
justify-content: space-between;
padding: 0em 2.99938em 0em 1.99937em;
}

.tag{
  -webkit-font-smoothing: antialiased;
margin: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
font-weight: 500;
font-size: 0.5625em;
border-radius: 4px;
transition: all 0.5s ease-in-out;
padding: 0.53125em 0.625em;
color: #0258a7;
border: 0.5px solid #0258a7;
}

.id{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
font-weight: 500;
font-size: 0.5625em;
transition: all 0.5s ease-in-out;
color: #8294aa;
}

.type{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
font-weight: 500;
font-size: 0.5625em;
transition: all 0.5s ease-in-out;
color: #8294aa;
}

.ad{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
font-weight: 500;
font-size: 0.5625em;
transition: all 0.5s ease-in-out;
color: #8294aa;
}

.phone{
  -webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-family: inherit;
line-height: 1.5;
font-weight: 500;
font-size: 0.5625em;
transition: all 0.5s ease-in-out;
color: #8294aa;
display: block;
}

.card-wrapper{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
z-index: 2;
display: flex;
overflow: hidden;
position: relative;
flex: 1 0 50%;
max-height: inherit;
padding-left: 2.5625em;
justify-content: flex-start;
}

.card-list{
  font-size: 100%;
-webkit-font-smoothing: antialiased;
margin: 0;
padding: 0;
box-sizing: inherit;
font-style: inherit;
font-weight: inherit;
font-family: inherit;
color: inherit;
line-height: 1.5;
display: flex;
flex-direction: column;
align-items: center;
justify-content: flex-start;
width: 37.375em;
max-width: 37.375em;
height: 1316px;
}

.cloned {
  position: absolute;
  z-index: -5;
  display: flex;
  margin-top: 0px;
  margin-bottom: 0px;
  padding-left: 0px;
  justify-content: flex-end;
}
</style>





<section class="hero">
  <div class="caption">
<div class="caption-wrapper">
  <h2 class="wrapper-title">
    Middle Point
    
  </h2>
    </div>
  </div>

<div class="card-wrapper">
<div class="card-list">
        
<div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Ronny Chavez
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $37.00
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#8695</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Social Ad
              </p>
              <p class="phone">
                +1-832-456-0000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Sarah Downes
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $22.00
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#8892</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Search Ad
              </p>
              <p class="phone">
                +1-832-498-000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Ellen Rankin
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $38.50
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#8901</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                News Website
              </p>
              <p class="phone">
                +1-832-444-0000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card cards-module--container_active--2H-cb">
          <div class="scrollingCard active--bbXT8">
            <div class="top top_active--tDJ_j">
              <div class="wrapper">
                <h4 class="title title_active--3eghZ">
                  Matthew Padilla
                </h4>
                <div class="info">
                  <p class="lead lead_active--3rDP9">
                    Lead Cost:
                  </p>
                  <p class="cost cost_active--19Z8M">
                    $21.75
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag"tag_active--UVZNS">
                New Lead
              </div>
              <p class="id id_active--3vX1f">
                #8925
              </p>
              <p class="type bottom_type_active--2EDy1">
                Medicare Supplement
              </p>
              <p class="ad ad_active--3wkhn">
                Search Ad
              </p>
              <p class="phone phone_active--3gy5a">
                +1-832-988-0000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Lenny Boyer
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $40.00
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#9034</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Social Ad
              </p>
              <p class="phone">
                +1-832-455-0000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Randy Johnson
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $50.00
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#9101</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Search Ad
              </p>
              <p class="phone">
                +1-832-444-2879
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Arianne Barrett
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $39.50
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#9184</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Banner Ad
              </p>
              <p class="phone">
                +1-832-844-0000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Kurt Hinton
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $24.50
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#9212</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Native Ad
              </p>
              <p class="phone">
                +1-832-466-000
              </p>
            </div>
          </div>
        </div>
        <div class="container scroll-card">
          <div class="scrollingCard">
            <div class="top">
              <div class="wrapper">
                <h4 class="title">
                  Randy Johnson
                </h4>
                <div class="info">
                  <p class="lead">
                    Lead Cost:
                  </p>
                  <p class="cost">
                    $50.00
                  </p>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="tag">
                New Lead
              </div>
              <p class="id">#9300</p>
              <p class="type">
                Medicare Supplement
              </p>
              <p class="ad">
                Search Ad
              </p>
              <p class="phone">
                +1-832-444-2879
              </p>
            </div>
          </div>
        </div>
                              </div>
</div>
                              </div>                              </section>
<!--<?php include('footer.php'); ?>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.0/gsap.min.js"></script>

<script>
    

    jQuery(($) => {
      // grab elememts
      let $wrapper = $('.card-wrapper')
      let $list = $wrapper.find('.card-list')
      let $clonedList = $list.clone()
      let cardLength = 0

      // set an offset of 4 pixels
      let listHeight = 4

      // add the height of all cards
      $list.find('.scroll-card').each((_, el) => {
        cardLength++

        listHeight += ['height', 'margin-top', 'margin-bottom']
          .map((key) =>
            parseInt(window.getComputedStyle(el).getPropertyValue(key), 10)
          )
          .reduce((prev, cur) => prev + cur)
      })

      // attach the calculation of the height as a style
      $list.add($clonedList).css({
        height: listHeight + 'px'
      })

      $clonedList.addClass('cloned').appendTo($wrapper)
      // execute animations
      let infinite = new TimelineMax({ repeat: -1, paused: true })
      let time = cardLength * 3
      
      // Zoom active
      function zoomMiddle(list) {
        const tl = gsap.timeline({repeat: -1});
        tl
          // .to(list, {
        .to(".scroll-card", {
          scale: 1.4,
          ease: CustomEase.create(
            "custom",
            "M0,0 C0,0.45 0.2,1 0.362,1 0.43,1 0.552,1 0.632,1 0.836,1 1,0.436 1,0"
          ), // Custom ease that scales and moves down again (add https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/CustomEase3.min.js)
          stagger: {
            amount: time * 2, // Should be synced with the amount it takes to to move up
            // from: 2 // Start from the second item, but than moves up and down 
          }
        })
        return tl;
      }
      
// Main timeline
      infinite
        .fromTo(
          $list,
          time,
          { y: 0 },
          { y: '-' + listHeight, ease: Linear.easeNone },
          0
        )
        .fromTo(
          $clonedList,
          time,
          { y: listHeight },
          { y: 0, ease: Linear.easeNone },
          0
        )
        // .add(zoomMiddle($(".scroll-card", $list)), 0)
        .add(zoomMiddle, 0)
        .play()

      $wrapper
        .on('mouseenter', () => infinite.pause())
        .on('mouseleave', () => infinite.play())
    })
</script>
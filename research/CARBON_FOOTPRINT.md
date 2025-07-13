# Website Carbon Footprint Tracking Research

*Research conducted: 2025-07-11*  
*Purpose: Establish carbon tracking before optimizing media-rich WordPress theme*

## Executive Summary

This research investigates tools and methodologies for tracking website carbon footprint to measure the impact of upcoming theme optimizations. The key finding is that **page weight directly correlates with carbon emissions**, with images contributing up to 80% of a website's carbon footprint.

## Research Findings

### 1. Carbon Footprint Tracking Tools

#### WordPress-Specific Solutions

**WordPress Carbon Calculator Plugin**
- **Functionality**: Real-time CO2 calculations in WordPress admin panel
- **Algorithm**: Built on Website Carbon Calculator algorithm 2.0 + Green Web Foundation's co2.js
- **Limitations**: 
  - Admin-only interface (no public display)
  - No historical data storage
  - No API for programmatic access
  - Manual calculation per page/post
- **Use Case**: Content creator awareness during editing

**Website Carbon API**
- **Provider**: Wholegrain Digital
- **Access**: Free for non-commercial use
- **Features**: REST API for carbon calculations based on page weight
- **Rate Limits**: Badge implementation caches results (max 1 call/day per page)

### 2. Automation Capabilities

#### Confirmed Automation Options

1. **GitHub Actions Integration**
   - Trigger carbon calculations on deployment
   - Store results in repository for version tracking
   - Compare before/after optimization metrics

2. **WordPress Plugin Automation**
   - Real-time calculations without API delays
   - Can be integrated into theme templates
   - Example: `<?php if($carbon = get_calculated_carbon()): ?>`

3. **Scheduled API Monitoring**
   - Cron jobs for regular carbon assessments
   - Automated data collection for all pages
   - Historical trend analysis

4. **CI/CD Pipeline Integration**
   - Automated carbon impact assessment for each deployment
   - Performance budget enforcement
   - Regression detection

### 3. Data Storage Format Recommendations

#### Optimal Structure: Time Series JSON

```json
{
  "timestamp": "2025-07-11T10:00:00Z",
  "site": "greenhouseculture.ie",
  "page_url": "/path/to/page",
  "metrics": {
    "carbon": {
      "co2_grams": 2.21,
      "green_hosting": true,
      "grid_intensity": "low"
    },
    "performance": {
      "page_weight_kb": 2500,
      "data_transfer_mb": 2.5,
      "load_time_ms": 3200,
      "requests_count": 45
    },
    "media": {
      "images_count": 15,
      "images_size_kb": 1800,
      "images_optimized": false,
      "video_count": 0,
      "video_size_kb": 0
    },
    "optimization": {
      "compression_enabled": false,
      "lazy_loading": false,
      "cdn_used": false,
      "cache_policy": "none"
    }
  },
  "baseline": {
    "is_baseline": true,
    "date": "2025-07-11"
  }
}
```

#### Export Formats Support
- **JSON**: For API integration and programmatic analysis
- **CSV**: For spreadsheet analysis and stakeholder reporting
- **Time Series Database**: InfluxDB for real-time monitoring

### 4. Performance-Carbon Correlation

#### Key Insights from Research

**Direct Correlation Factors:**
- **Page Weight = Carbon Impact**: More data transfer = higher energy consumption
- **Images = 80% of Impact**: Visual content is primary carbon contributor
- **Load Time**: Slower sites require more energy across the delivery chain

**Quantified Impact:**
- Average page weight increased 4x from 2011 to 2023
- Desktop: 524KB → 2361KB
- Mobile: 202KB → 2076KB
- Real example: 2.21g CO2e per page view = 13,315 smartphone charges annually for 49,529 views

**Optimization Impact Potential:**
- Image optimization can reduce carbon footprint by up to 4x
- CDN usage reduces transmission distance and energy
- Compression and modern formats (WebP) significantly reduce transfer

### 5. Reporting & Visualization Options

#### Recommended Stack: TIG (Telegraf, InfluxDB, Grafana)

**InfluxDB**
- Time-series database optimized for metrics storage
- Handles billions of data points per second
- Built-in data retention and compression

**Grafana**
- Real-time dashboards and alerting
- Multiple data source support
- Custom visualization panels

**Implementation Examples:**
- **Kepler + Prometheus + Grafana**: For infrastructure carbon monitoring
- **Hardware Sentry + OpenTelemetry**: For data center emissions tracking
- **Custom Dashboard**: Website-specific carbon metrics

#### Dashboard Features
- Real-time carbon emissions tracking
- Historical trend analysis
- Performance correlation graphs
- Optimization impact measurement
- Alert thresholds for carbon budgets

## Implementation Considerations

### Baseline Establishment Requirements
1. **Pre-optimization measurements** for all major pages
2. **High-traffic page prioritization** for maximum impact
3. **Media audit** - cataloging current image sizes, formats, optimization status
4. **Performance benchmarking** - current load times, request counts

### Automation Strategy
1. **GitHub Actions workflow** for deployment-triggered measurements
2. **Daily scheduled monitoring** via cron jobs
3. **Real-time calculation** for content creators during editing
4. **Historical data preservation** for trend analysis

### Reporting Framework
1. **Weekly carbon reports** showing optimization progress
2. **Monthly trend analysis** for stakeholder updates
3. **Quarterly sustainability reporting** for compliance/transparency
4. **Real-time dashboards** for ongoing monitoring

## Next Steps

### Phase 1: Tool Selection & Setup
- Choose between WordPress plugin (limited) vs. API-based solution (comprehensive)
- Establish baseline measurements before optimization begins
- Set up data storage infrastructure

### Phase 2: Automation Implementation
- Configure automated monitoring
- Integrate with deployment pipeline
- Create initial dashboards

### Phase 3: Optimization & Measurement
- Begin theme optimization initiative
- Continuous carbon impact measurement
- Track ROI of optimization efforts

## Key Limitations Identified

1. **WordPress Plugin Constraints**: No API access, no historical storage, admin-only interface
2. **API Rate Limits**: Free tiers have usage restrictions
3. **Calculation Accuracy**: Estimates based on data transfer, not actual energy consumption
4. **Green Hosting Detection**: Limited accuracy in determining hosting carbon intensity

## Recommended Approach

For comprehensive carbon tracking during theme optimization:

1. **Use Website Carbon API** for automated measurements
2. **Implement custom data storage** in JSON format for flexibility
3. **Create GitHub Actions workflow** for deployment integration
4. **Set up Grafana dashboard** for real-time monitoring
5. **Establish carbon budget thresholds** to maintain improvements

This approach provides the automation, historical tracking, and reporting flexibility needed to measure optimization impact effectively while enabling future reporting requirements.

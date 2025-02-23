import * as React from 'react';
import { useTheme } from '@mui/material/styles';
import Box from '@mui/material/Box';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import Stack from '@mui/material/Stack';
import Typography from '@mui/material/Typography';
import { SparkLineChart } from '@mui/x-charts/SparkLineChart';
import { areaElementClasses } from '@mui/x-charts/LineChart';

function getDaysInMonth(month, year) {
  const date = new Date(year, month, 0);
  const monthName = date.toLocaleDateString('en-US', { month: 'short' });
  const daysInMonth = date.getDate();
  return Array.from({ length: daysInMonth }, (_, i) => `${monthName} ${i + 1}`);
}

function generateChartData(transactions, month, year) {
  const daysInMonth = getDaysInMonth(month, year);
  let cumulativeValue = 0;
  const dataPoints = new Array(daysInMonth.length).fill(0);

  transactions.forEach(transaction => {
    const transactionDate = new Date(transaction.date_income || transaction.date_expense);
    
    if (
      transactionDate.getMonth() + 1 === month &&
      transactionDate.getFullYear() === year
    ) {
      const dayIndex = transactionDate.getDate() - 1;
      const value = parseFloat(transaction.value) || 0;
      
      // Se for despesa, converte o valor para negativo
      const adjustedValue = transaction.date_expense ? -value : value;

      cumulativeValue += adjustedValue;
      dataPoints[dayIndex] = cumulativeValue;
    }
  });

  let lastValue = 0;
  return dataPoints.map(value => {
    if (value !== 0) {
      lastValue = value;
    }
    return lastValue;
  });
}

function AreaGradient({ color, id }) {
  return (
    <defs>
      <linearGradient id={id} x1="50%" y1="0%" x2="50%" y2="100%">
        <stop offset="0%" stopColor={color} stopOpacity={0.3} />
        <stop offset="100%" stopColor={color} stopOpacity={0} />
      </linearGradient>
    </defs>
  );
}

export default function CardActivitie({
  title,
  value,
  interval,
  trend,
  data = []
}) {
  const theme = useTheme();
  const currentDate = new Date();
  const currentMonth = currentDate.getMonth() + 1;
  const currentYear = currentDate.getFullYear();

  const daysInMonth = getDaysInMonth(currentMonth, currentYear);
  const chartData = generateChartData(data, currentMonth, currentYear);

  const trendColors = {
    up: theme.palette.success.main,
    down: theme.palette.error.main,
    neutral: theme.palette.grey[400],
  };

  const labelColors = {
    up: 'success',
    down: 'error',
    neutral: 'default',
  };

  const color = labelColors[trend] || 'default';
  const chartColor = trendColors[trend] || theme.palette.grey[500];

  return (
    <Card variant="outlined" sx={{ height: '100%', flexGrow: 1 }}>
      <CardContent>
        <Typography component="h2" variant="subtitle2" gutterBottom>
          {title}
        </Typography>
        <Stack direction="column" sx={{ justifyContent: 'space-between', flexGrow: 1, gap: 1 }}>
          <Stack sx={{ justifyContent: 'space-between' }}>
            <Stack direction="row" sx={{ justifyContent: 'space-between', alignItems: 'center' }}>
              <Typography variant="h4" component="p">
                {value}
              </Typography>
            </Stack>
            <Typography variant="caption" sx={{ color: 'text.secondary' }}>
              {interval}
            </Typography>
          </Stack>
          <Box sx={{ width: '100%', height: 50 }}>
            <SparkLineChart
              colors={[chartColor]}
              data={chartData}
              area
              showHighlight
              showTooltip
              xAxis={{ scaleType: 'band', data: daysInMonth }}
              sx={{
                [`& .${areaElementClasses.root}`]: {
                  fill: `url(#area-gradient-${title})`,
                },
              }}
            >
              <AreaGradient color={chartColor} id={`area-gradient-${title}`} />
            </SparkLineChart>
          </Box>
        </Stack>
      </CardContent>
    </Card>
  );
}

import * as React from 'react';
import { PieChart } from '@mui/x-charts/PieChart';
import { useDrawingArea } from '@mui/x-charts/hooks';
import { styled } from '@mui/material/styles';
import Typography from '@mui/material/Typography';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import Box from '@mui/material/Box';

const StyledText = styled('text')(({ theme, variant }) => ({
  textAnchor: 'middle',
  dominantBaseline: 'central',
  fill: (theme.vars || theme).palette.text.secondary,
  fontSize: variant === 'primary' ? theme.typography.h5.fontSize : theme.typography.body2.fontSize,
  fontWeight: variant === 'primary' ? theme.typography.h5.fontWeight : theme.typography.body2.fontWeight,
}));

function PieCenterLabel({ primaryText, secondaryText }) {
  const { width, height, left, top } = useDrawingArea();
  const primaryY = top + height / 2 - 10;
  const secondaryY = primaryY + 24;

  return (
    <>
      <StyledText variant="primary" x={left + width / 2} y={primaryY}>
        {primaryText}
      </StyledText>
      <StyledText variant="secondary" x={left + width / 2} y={secondaryY}>
        {secondaryText}
      </StyledText>
    </>
  );
}

const colors = ['hsl(220, 20%, 65%)', 'hsl(220, 20%, 42%)'];

export default function CardRatio({ data, total }) {
  if (!data || data.length === 0) return null;

  return (
    <Card
      variant="outlined"
      sx={{ 
        display: 'flex',
        flexDirection: 'column',
        gap: '8px',
        flexGrow: 1,
        width: "100%",
        minWidth: 200,
        maxWidth: 460,
        minHeight: 300,
        paddingX: 6,
        paddingY: 4,
      }}
    >
      <CardContent>
        <Typography component="h2" variant="subtitle2">
            Movimento Total no Período
        </Typography>
        <Box sx={{ display: 'flex', alignItems: 'center' }}>
          <PieChart
            colors={colors}
            margin={{ left: 80, right: 80, top: 80, bottom: 80 }}
            series={[
              {
                data,
                innerRadius: 75,
                outerRadius: 100,
                paddingAngle: 0,
                highlightScope: { faded: 'global', highlighted: 'item' },
              },
            ]}
            height={260}
            width={260}
            slotProps={{
              legend: { hidden: true },
            }}
          >
            <PieCenterLabel primaryText={`€${total.toFixed(2)}`} secondaryText="Saldo Mensal" />
          </PieChart>
        </Box>
      </CardContent>
    </Card>
  );
}
